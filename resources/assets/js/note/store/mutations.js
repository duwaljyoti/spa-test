export default {
  ['GET'](state, notes) {
    state.notes = notes;
  },
  ['GET_FAVOURITE'](state, notes) {
    state.favouriteNotes = notes;
  },
  ['SAVE'](state) {

  }
}