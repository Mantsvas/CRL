/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


//  Containers
Vue.component('clan-container', require('./containers/Clan.vue').default);


// Components
Vue.component('clan-info-component', require('./components/clan/InfoComponent').default);
Vue.component('clan-members-component', require('./components/clan/MembersComponent').default);
Vue.component('clan-river-race-component', require('./components/clan/RiverRaceComponent').default);
Vue.component('clan-river-race-log-component', require('./components/clan/RiverRaceLogComponent').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
