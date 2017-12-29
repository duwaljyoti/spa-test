<template>
    <div>
        <flash>
        </flash>
        <nav-bar @note-route-changed="changeRoute('favourite')">
        </nav-bar>
        <div id="notes-list">
            <div id="list-header">
                <h2>{{ noteTitle }}</h2>
            </div>
            <div class="container">
                <div class="list-group">
                    <a class="list-group-item" href="#" v-for="note in noteList"
                       :class="activeNote.id === note.id ? 'active' : ''"
                    >
                        <h4 class="list-group-item-heading" @click="toggleActiveClass(note)">
                            <span v-if="beingEditedNote.id !== note.id">
                                {{ note.title }} &nbsp
                            </span>
                            <span v-if="loggedUser">
                                <div v-if="loggedUser.id === note.user_id" class="glyphicon glyphicon-trash" title="Delete Note"
                                     @click="deleteNote(note)"></div> &nbsp

                                <div
                                        :class="[favouriteNoteIdList.indexOf(note.id) <= 0 ? heartClass + '-empty' : heartClass]"
                                        :title="[favouriteNoteIdList.indexOf(note.id) <= 0 ? 'Favourite' : 'Un Favourite']"
                                        @click="toggleFavourite(note, note.is_favourite)"
                                >

                                </div> &nbsp
                                <div v-if="beingEditedNote.id !== note.id && note.user_id === loggedUser.id"
                                     class="glyphicon glyphicon-pencil" title="Edit Note"
                                     @click="editNote(note)"></div>

                                <div v-if="isBeingEdited && activeNote.id === note.id">
                                    <input type="text" :placeholder="note.title" v-model="editingNote.title">
                                    <div class="glyphicon glyphicon-ok" title="Save" @click="update(note.id)"></div> &nbsp
                                </div>
                            </span>
                        </h4>
                    </a>
                </div>
            </div>
        </div>
        <div v-if="noteList.length">
            <div v-if="!isBeingEdited">
                {{ activeNote.description }}
            </div>
            <div v-else>
                <input type="text" :placeholder="activeNote.description" v-model="editingNote.description">
            </div>
        </div>
    </div>
</template>

<script>
  import { mapState, mapActions } from 'vuex';
  import Flash from '../../components/Flash';
  import axios from 'axios';
  import NavBar from '../../components/NavBar';

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
          this.getAll();
        } else {
          this.getFavourite();
        }
        setTimeout(() => {
          this.noteList = this.currentRoute ? this.favouriteNotes : this.notes;
        }, 1000);
      },
      deleteNote(note) {
        this.$store.dispatch('deleteNote', note);
        this.$emit('flash', { message: 'Note Deleted.' });
        this.get();
      },
      ...mapActions([
        'getAll',
        'getFavourite',
      ]),
      changeRoute(type = null) {
        this.currentRoute = type;
        this.get();
      },
      toggleFavourite(note, is_favourite) {
        this.$store.dispatch('toggleFavourite', note.id);
        this.get();
        const message = is_favourite ? 'Unfavourited Successfully' :'Favourited successfully.';
        this.$emit('flash', {message});
        this.getFavouriteId();
      },
      editNote(note) {
        this.isBeingEdited = true;
        this.beingEditedNote = note;
      },
      update(noteId) {
        this.editingNote.title = this.editingNote.title ? this.editingNote.title : this.beingEditedNote.title;
        this.editingNote.description = this.editingNote.description ? this.editingNote.description : this.beingEditedNote.description;
        this.$store.dispatch('update',{
          noteId: noteId,
          updatedNote:this.editingNote
        })
          .then(() => {
            this.isBeingEdited = false;
            this.beingEditedNote = {};
            this.get();
            this.$emit('flash', { message: 'Note Updated.' });
          });
      },
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
    }
  }
</script>