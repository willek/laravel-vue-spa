/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import VueResource from 'vue-resource';

Vue.use(VueRouter);
Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;

import App from './components/App';
import Home from './components/Home';

import NotFound from './components/Error/404';

import BooksIndex from './components/Books/Index';
import BooksCreate from './components/Books/Create';
import BooksEdit from './components/Books/Edit';

Vue.component('App', App);
Vue.component('Home', Home);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/404',
            name: '404',
            component: NotFound
        },
        {
            path: '*',
            redirect: '/404'
        },
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/books',
            name: 'books.index',
            component: BooksIndex,
        },
        {
            path: '/books/create',
            name: 'books.create',
            component: BooksCreate,
        },
        {
            path: '/books/:id/edit',
            name: 'books.edit',
            component: BooksEdit,
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
