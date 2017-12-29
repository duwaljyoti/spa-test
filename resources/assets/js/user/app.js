import Vue from 'vue';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import routes from './routes';
import store from './store';

Vue.use(VueRouter);
Vue.use(Vuex);

const router = new VueRouter({
  routes,
});

const userApp = new Vue({
  router,
  store,
});

userApp.$mount('#app');