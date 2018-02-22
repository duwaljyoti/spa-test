<template>
  <div>
    <loading :loading="loading">
    </loading>
    <flash>
    </flash>
    <nav-bar @note-route-changed="changeRoute('favourite')">
    </nav-bar>
    <div id="notes-list">
      <div id="list-header">
        <h2>{{ noteTitle }}</h2>
      </div>
      <div class="container">
        <div class="list-group" v-if="noteList.length">
          <a class="list-group-item" href="#" v-for="note in noteList"
             :class="activeNote.id === note.id ? 'active' : ''"
          >
            <h4 class="list-group-item-heading" @click="toggleActiveClass(note)">
                            <span v-if="beingEditedNote.id !== note.id">
                                {{ note.title }} &nbsp
                            </span>
              <span v-if="beingEditedNote.id !== note.id">
                                    <div v-if="loggedUser.id === note.user_id" class="glyphicon glyphicon-trash"
                                         title="Delete Note"
                                         @click="deleteNote(note)"></div> &nbsp
                                    <div
                                      :class="[favouriteNoteIdList.indexOf(note.id) < 0 ? heartClass + '-empty' : heartClass]"
                                      :title="[favouriteNoteIdList.indexOf(note.id) < 0 ? 'Favourite' : 'Un Favourite']"
                                      @click="toggleFavourite(note, favouriteNoteIdList.indexOf(note.id) > -1)"
                                    >
                                    </div>
                                </span>

              &nbsp
              <div v-if="beingEditedNote.id !== note.id && note.user_id === loggedUser.id"
                   class="glyphicon glyphicon-pencil" title="Edit Note"
                   @click="editNote(note)"></div>

              <div v-if="isBeingEdited && activeNote.id === note.id">
                <input type="text" class="inputText" v-model="beingEditedNote.title">
                <div class="glyphicon glyphicon-ok" title="Save" @click="update(note.id)"></div>
                &nbsp
              </div>
            </h4>
          </a>
        </div>
        <div v-else>
                    <span>
                        Looks like you dont have any notes at th moment.
                        <router-link to="/create">Add</router-link>
                    </span>
        </div>
      </div>
    </div>
    <div v-if="noteList.length" class="cheat">
      <div v-if="!isBeingEdited">
        {{ activeNote.description }}
      </div>
      <div v-else>
        <input type="text" :placeholder="activeNote.description" v-model="beingEditedNote.description">
      </div>
    </div>
  </div>
</template>
<style>
  .inputText {
    color: black;
  }
  .cheat{
    padding-left: 330px;
    padding-top: 30px;
    font-size: 14px;
  }
  #list-header {
    padding: 20px;
  }
  #list-header h2{
    padding: 0;
    margin: 0;
  }
</style>
<script>
  import { mapState, mapActions } from 'vuex';
  import Flash from '../../components/Flash';
  import axios from 'axios';
  import NavBar from '../../components/NavBar';
  import Loading from '../../components/Loading';
  import { noteFavouritedSuccessfully, noteUnFavouritedSuccessfully } from '../../message';

  export default {
    data() {
      return {
        activeNote: '',
        currentRoute: '',
        noteList: [],
        isBeingEdited: false,
        beingEditedNote: {},
        editingNote: {},
        loggedUser: {},
        favouriteNoteIdList: [],
        loading: true,
      }
    },
    name: 'Note',
    created() {
      this.loggedUser = window.loggedUser;
      this.getFavouriteId();
    },
    mounted() {
      this.currentRoute = this.$route.query.type;
      this.get();
      setTimeout(() => {
        this.toggleActiveClass();
      }, 1500);
    },
    methods: {
      toggleActiveClass(note) {
        this.activeNote = note ? note : (this.noteList ? this.noteList[0] : {});
      },
      getFavouriteId() {
        if (this.loggedUser && this.loggedUser.id) {
          axios.get(`api/users/${this.loggedUser.id}/getFavouriteNotesId`)
            .then(resp => this.favouriteNoteIdList = resp.data);
        }
      },
      get() {
        if (!this.currentRoute) {
          this.getAll()
            .then(() => {
              this.setNoteList();
            })
            .finally(() => this.setLoading())
          ;
        } else {
          const self = this;
          this.getFavourite()
            .then(() => {
              self.activeNote = {};
              this.setNoteList();
              self.toggleActiveClass();
            })
            .finally(() => this.setLoading())
        }
      },
      deleteNote(note) {
        this.$store.dispatch('deleteNote', note)
          .then(() => {
            this.$emit('flash', { message: 'Note Deleted.' });
            this.get();
          });
      },
      ...mapActions([
        'getAll',
        'getFavourite',
      ]),
      changeRoute(type = null) {
        this.setLoading(true);
        this.currentRoute = type;
        this.get();
        this.editNote(false);
      },
      toggleFavourite(note, is_favourite) {
        this.$store.dispatch('toggleFavourite', note.id);
        this.get();
        const message = is_favourite ? noteFavouritedSuccessfully : noteUnFavouritedSuccessfully;
        this.$emit('flash', { message });
        this.getFavouriteId();
      },
      editNote(note) {
        this.isBeingEdited = !! note;
        this.beingEditedNote = note ? note : {};
      },
      update(noteId) {
        this.editingNote.title = this.editingNote.title ? this.editingNote.title : this.beingEditedNote.title;
        this.editingNote.description = this.editingNote.description ? this.editingNote.description : this.beingEditedNote.description;
        this.$store.dispatch('update', {
          noteId: noteId,
          updatedNote: this.editingNote
        })
          .then(() => {
            this.isBeingEdited = false;
            this.beingEditedNote = {};
            this.$emit('flash', {message: 'Note Updated.'});
            this.activeNote.description = this.editingNote.description;
            this.get();
          });
      },
      setLoading(status = false) {
        this.loading = status;
      },
      setNoteList() {
        this.noteList = this.currentRoute ? this.favouriteNotes : this.notes;
      }
    },
    computed: {
      ...mapState([
        'notes',
        'favouriteNotes',
      ]),
      noteTitle() {
        return this.currentRoute === 'favourite' ? 'Favourite Notes' : 'Notes';
      },
      heartClass() {
        return 'glyphicon glyphicon-heart';
      }
    },
    components: {
      Flash,
      NavBar,
      Loading,
    }
  }
</script>