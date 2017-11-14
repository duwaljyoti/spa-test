import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

const notesStore = new Vuex.Store({
    state: {
        notes: [],
        favouriteNotes: []
    },
    mutations: {
        FETCH(state, notes) {
            state.notes = notes;
        },
        DELETE_NOTE({ commit, state }, noteId) {
            // this.dispatch('fetch');
        },
        FETCH_FAVOURITE(state, favouriteNotes) {
            state.favouriteNotes = favouriteNotes;
        }
    },
    actions: {
        fetch({ commit }) {
            return axios.get('/api/notes')
                .then((response) => {
                    const notes = response.data;
                    // state.notes.push(...notes);
                    commit('FETCH', notes)
                })
                .catch();
        },
        deleteNote({ commit }, noteId) {
            axios.delete(`/api/notes/${noteId}`)
                .then(() => {
                    this.dispatch('fetch');
                })
                .catch((error) => {
                });
        },
        edit({commit}, note) {
            axios.put(`/api/notes/${note.id}`, {
                title: note.title
            })
                .then((response) => {
                  this.dispatch('fetch');
                });
        },
        favourite({}, id) {
            axios.put(`/api/notes/${id}/favourite`, {
                is_favourite: true
            })
              .then((response) => {
                this.dispatch('fetch');
              })
        },
        fetchFavourite({commit}) {
          return axios.get('/api/notes?type=favourite')
            .then((response) => {
              commit('FETCH_FAVOURITE', response.data)
            })
            .catch();
        },
        add({commit}, title) {
            axios.post('/api/notes', {
                'title': title,
                'user_id': 1,
                'is_favourite': false,
            })
                .then((response) => {
                });
        }
    }
});

export default notesStore;

