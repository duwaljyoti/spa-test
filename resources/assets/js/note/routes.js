import Note from './components/Note.vue';
import Create from './components/Create.vue';

const routes = [
  { path: '/', name: 'note', component: Note },
  { path: '/create', name: 'create', component: Create },
  { path: '*', redirect: '/' },
];

export default routes;