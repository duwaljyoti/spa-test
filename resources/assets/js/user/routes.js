import User from './components/User.vue';

const routes = [
  {
    path: '/',
    name: 'user',
    component: User,
    meta: { requiresAuth: true },
  },
  {
    path: '*',
    redirect: '/',
    meta: { requiresAuth: true }
  },

];

export default routes;