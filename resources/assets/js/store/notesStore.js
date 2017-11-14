import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import notes from '../api';

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
        FETCH_FAVOURITE(state, favouriteNotes) {
            state.favouriteNotes = favouriteNotes;
        }
    },
    actions: {
        fetch({ commit }) {
            return axios.get(notes)
                .then(response => commit('FETCH', response.data))
                .catch();
        },
        deleteNote({}, id) {
            axios.delete(`${notes}/${id}`)
                .then(() => this.dispatch('fetch'))
                .catch();
        },
        edit({}, note) {
            axios.put(`${notes}/${note.id}`, {
                title: note.title
            })
                .then(() => this.dispatch('fetch'));
        },
        toggleFavourite({}, id) {
            axios.put(`${notes}/${id}/toggleFavourite`, {
                is_favourite: true
            })
              .then(() => this.dispatch('fetch'))
        },
        fetchFavourite({commit}) {
          return axios.get(`${notes}?type=favourite`)
            .then(response => commit('FETCH_FAVOURITE', response.data))
            .catch();
        },
        add({}, title) {
            axios.post(`${notes}`, {
                'title': title,
                'is_favourite': false,
            });
        }
    }
});

export default notesStore;

