/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');
window.jQuery = require('jquery');
window.$ = window.jQuery;
Vue.config.silent = true;

require('foundation-sites');
require('lodash');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('blog-editor', require('./components/BlogEditor.vue'));
Vue.component('blog-manager', require('./components/BlogManager.vue'));
Vue.component('image-uploader', require('./components/ImageUploader.vue'));

new Vue({
    el  : '#myApp',
    data : {}
});

// Required for laravel ajax calls
function bindAjaxCsrf() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

function bindFoundation() {
    Foundation.Abide.defaults.patterns['zip']          = /^\d{5}(-\d{4})?$/;
    Foundation.Abide.defaults.validators['min_length'] = function ($el, required, parent) {
        if (!required) return true;
        var minLength = $el.attr('data-min-length') || 1,
            length    = $el.val().length;
        return length >= minLength;
    };
    $(document).foundation();
    $(document).trigger('foundationLoaded');

}

function init() {
    $(function () {
        // Initialize everything here
        bindAjaxCsrf();
        bindFoundation();
    });

}

init();


