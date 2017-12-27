export default {
  ['GET'](state, users) {
    state.users = users;
  },
  ['GET_USER_NOTES'](state, userNotes) {
    state.userNotes = userNotes;
  }
}