import Vue from 'vue';
import VueRouter from 'vue-router';
import TestNote from './components/TestNote.vue';
import routes from './routes';
import notesStore from './store/notesStore';

Vue.use(VueRouter);

const router = new VueRouter({
    routes
});

new Vue({
    el: '#app',
   render: h => h(TestNote),
    router,
    store: notesStore,
});

// const testNote = new Vue({
//     el: '#app',
//     components: {
//         TestNote
//     }
// });