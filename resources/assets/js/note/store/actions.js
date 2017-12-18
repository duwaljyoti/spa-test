import axios from 'axios';
import RESOURCE_NOTE from '../api';

export default {
  getAll({commit}) {
    return axios.get(RESOURCE_NOTE)
      .then((response) => {
        commit('GET', response.data);
      })
      .catch();
  },
  save({commit}, note) {
    note.is_favourite = false;
    note.user_id = 1;
    return axios.post(RESOURCE_NOTE, note)
      .then((response) => {
      })
      .catch((err) => {
        console.log(err);
      });
  }
}
