import Note from './Note.vue';
import Create from './Create.vue';
import TestComponent2 from './TestComponent2.vue';

const routes = [
  { path: '/', component: Note },
  { path: '/test1', component: TestComponent2 },
  { path: '/create', component: Create },
  { path: '*', redirect: '/' },
];

export default routes;