
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';
import Vuikit from 'vuikit';
import VueRouter from 'vue-router'
import Notifications from 'vue-notification'

Vue.use(Vuikit);
Vue.use(VueRouter);
Vue.use(Notifications);
UIkit.use(Icons);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import routes from './routes'

let router = new VueRouter({
    routes
});

router.afterEach(route => {
    document.title = route.meta.title;
});

window.onload = function () {
    new Vue({
        el: '#app',
        router : router
    });
};
