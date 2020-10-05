/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

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
