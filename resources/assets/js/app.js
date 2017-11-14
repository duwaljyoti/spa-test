import Vue from 'vue';
import VueRouter from 'vue-router';
import TestNote from './components/TestNote.vue';
import routes from './routes';
import notesStore from './store/notesStore';

Vue.use(VueRouter);

const router = new VueRouter({
    routes
});

window.flash = function(message) {
    document.getElementById("messageBody").style.visibility = 'visible';
    document.getElementById("messageBody").innerHTML = message;
    setTimeout(() => {
        document.getElementById("messageBody").style.visibility = 'hidden';
    }, 1000)
};

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