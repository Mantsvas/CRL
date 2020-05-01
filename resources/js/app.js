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

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

generateMsg = function generateMsg(type, msg) {
if (msg.length != null) {
    if ($.inArray(type, ['danger', 'warning', 'success', 'info']) != -1) {
    var message = '<div class="alert alert-' + type + ' alert-block">' + '<button type="button" class="close" data-dismiss="alert">&times;</button>' + '<strong>' + msg + '</strong>' + '</div>';
    }
}
    clearMsg();
    showMsg(message);
};

showMsg = function showMsg(msg) {
    var flash = $('#flash')[0];
    var old_msg = flash.innerHTML;

    if (!old_msg.includes(msg)) {
        flash.innerHTML = msg + old_msg;
    } else {
        flash.innerHTML = msg;
    }
};

clearMsg = function clearMsg() {
    $('#flash')[0].innerHTML = '';
};
