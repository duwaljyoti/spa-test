import Vue from 'vue';
import Vuex from 'vuex';
import state from './state';
import actions from './actions';
import mutations from './mutations';
import noteActions from '../../note/store/actions';

Vue.use(Vuex);

const noteModule = {
  state: {},
  actions: noteActions,
  mutations: {},
};

const userModule = {
  state,
  actions,
  mutations,
};

const store = new Vuex.Store({
  modules: {
    userModule,
    noteModule,
  }
});
export default store;

