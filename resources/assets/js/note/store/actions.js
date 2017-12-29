import axios from 'axios';
import RESOURCE_NOTE from '../api';
import notes from "../../api";

export default {
  getAll({commit}) {
    return axios.get(RESOURCE_NOTE)
      .then((response) => {
        commit('GET', response.data);
      })
      .catch();
  },

  getFavourite({commit}) {
    return axios.get(RESOURCE_NOTE + '?type=favourite')
      .then((response) => {
        commit('GET_FAVOURITE', response.data);
      })
      .catch();
  },

  save({commit}, note) {
    note.is_favourite = false;
    note.user_id = window.loggedUser.id;
    return axios.post(RESOURCE_NOTE, note)
      .then((response) => {
      })
      .catch((err) => {
        console.log(err);
      });
  },

  deleteNote({commit}, note) {
    return axios.delete(`${RESOURCE_NOTE}/${note.id}`)
      .then(resp => console.log(resp));
  },

  toggleFavourite({}, id) {
    axios.put(`${notes}/${id}/toggleFavourite`, {
      is_favourite: true
    });
  },

  update({commit} ,noteDetails) {
    axios.put(`${RESOURCE_NOTE}/${noteDetails.noteId}`, noteDetails.updatedNote)
      .then(resp => console.log(resp));
  }
}
