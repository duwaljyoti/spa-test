import CreateNote from './components/CreateNote.vue'
import List from './components/List.vue'
import FavouriteList from './components/FavouriteList.vue'

const routes = [
    { path: '/', component: List },
    { path: '/create', component: CreateNote },
    { path: '/list', component: List },
    { path: '/favourite-list', component: FavouriteList },
    { path: '*', redirect: '/list' },
];

export default routes;