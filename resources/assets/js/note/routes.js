import Note from './components/Note.vue';
import Create from './components/Create.vue';

const routes = [
  { path: '/', name: 'note-main', component: Note },
  { path: '/create', component: Create },
  { path: '*', redirect: '/' },
];

export default routes;