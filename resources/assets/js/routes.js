import CreateNote from './components/CreateNote.vue'
import TestNote from './components/TestNote.vue'
import List from './components/List.vue'
import FavouriteList from './components/FavouriteList.vue'

const routes = [
    {
        path: '/',
        component: TestNote
    },
    {
        path: '/create',
        component: CreateNote
    },
    {
        path: '/list',
        component: List
    },
    {
        path: '/favourite-list',
        component: FavouriteList
    }
];

export default routes;