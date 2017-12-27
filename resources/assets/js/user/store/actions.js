import axios from 'axios';
import users from '../api';

export default {
  get({commit}) {
    axios.get(users)
      .then(resp => commit('GET', resp.data));
  },
  getUserNotes({commit}, user) {
    axios.get(`${users}/${user}/notes`)
      .then(resp => commit('GET_USER_NOTES', resp.data));
  }
}