import Vue from 'vue';
import Vuex from 'vuex'
import VueRouter from'vue-router'
import routes from './routes';
import store from './store/index';

Vue.use(VueRouter);
Vue.use(Vuex);

const router = new VueRouter({
  routes,
});

const NoteApplication = new Vue({
  router,
  store,
});

NoteApplication.$mount('#app');