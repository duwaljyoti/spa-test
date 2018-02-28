<template>
    <div>
        <flash>
        </flash>
        <loading :loading="loading">
        </loading>
        <nav-bar>
        </nav-bar>
        <div id="notes-list">
            <v-select v-model="selectedUser" label="name" :options="userModule.users">
            </v-select>
            <div id="list-header">
                <h2>User Notes</h2>
            </div>
            <div class="container">
                <div class="list-group">
                    <div v-if="userModule.userNotes.length && selectedUser">
                    <a class="list-group-item" href="#" v-for="note in userModule.userNotes"
                       :class="(activeNote && activeNote.id === note.id) ? 'active' : ''"
                    >
                        <h4 class="list-group-item-heading" @click="toggleActiveClass(note)">
                            {{ note.title }} &nbsp
                            <div
                                    :class="[favouriteNoteIdList.indexOf(note.id) < 0 ? 'glyphicon glyphicon-heart' + '-empty' : 'glyphicon glyphicon-heart']"
                                    :title="[favouriteNoteIdList.indexOf(note.id) < 0 ? 'Favourite' : 'Un Favourite']"
                                    @click="toggleFavourite(note, favouriteNoteIdList.indexOf(note.id) > -1)"
                            >
                            </div>
                        </h4>

                    </a>
                    </div>
                    <div v-else>
                    <a class="list-group-item" href="#">
                        <h4 class="list-group-item-heading">
                            No Notes Found!
                        </h4>
                    </a>
                    </div>
                </div>
            </div>
        </div>
        {{ (activeNote && selectedUser) ? activeNote.description : '' }}
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex';
    import NavBar from '../../components/NavBar';
    import Flash from '../../components/Flash';
    import Loading from '../../components/Loading';
    import vSelect from 'vue-select';
    import axios from 'axios';
    import { noteFavouritedSuccessfully, noteUnFavouritedSuccessfully } from '../../message';

    export default {
      name: 'user',
      data() {
        return {
          selectedUser: null,
          activeNote: {},
          favouriteNoteIdList: [],
          loading: true,
        }
      },
      mounted() {
        this.loggedUser = window.loggedUser;
        this.get()
          .then(() => {
            this.loading = false;
          });
        this.getFavouriteId();
      },

      methods: {
        ...mapActions([
          'get',
          'getUserNotes',
          'toggleFavourite',
          'getUserFavouriteId',
        ]),
        toggleActiveClass(note = null, setActiveNoteNull = false) {
          this.activeNote = setActiveNoteNull ? {} : (note ? note : (this.userNotes ? this.userNotes[0] : {}));
        },
        getFavouriteId() {
          this.loading = true;
          this.getUserFavouriteId(this.loggedUser.id)
            .then((resp) => this.favouriteNoteIdList = resp )
            .finally(() => this.loading = false);
        },
        toggleFavourite(note, noteIsFavourited) {
          this.$store.dispatch('toggleFavourite', note.id)
            .then(() => {
              this.getFavouriteId();
              this.$emit('flash', { message: noteIsFavourited ? noteUnFavouritedSuccessfully
                  : noteFavouritedSuccessfully });
            });
        },
      },
      computed: {
        ...mapState(['userModule']),
      },
      watch: {
        selectedUser() {
          this.activeNote = {};
          if (this.selectedUser) {
            this.getUserNotes(this.selectedUser.id)
              .then((resp) => {
              });
          } else {
            this.toggleActiveClass(null, true);
          }
        }
      },
      components: {
        Flash,
        NavBar,
        vSelect,
        Loading,
      }
    }
</script>