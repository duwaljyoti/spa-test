import Vue from 'vue';
import VueRouter from 'vue-router';
import NoteApp from './components/NoteApp.vue';
import routes from './routes';
import notesStore from './store/notesStore';

Vue.use(VueRouter);

const router = new VueRouter({
    routes,
    // mode: 'history',
});
console.log(983795873983435);
window.events = new Vue();


new Vue({
    el: '#app',
    render: h => h(NoteApp),
    router,
    store: notesStore,
});