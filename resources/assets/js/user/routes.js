import User from './components/User.vue';

const routes = [
  { path: '/', name: 'user', component: User },
  { path: '*', redirect: '/' },

];

export default routes;