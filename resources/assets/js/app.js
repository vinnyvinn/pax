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

Vue.component('approval-index', require('./components/approval/Index.vue'));
Vue.component('clearing-index', require('./components/clearing/index.vue'));
Vue.component('tabulations', require('./components/tabulations/create.vue'));
Vue.component('non-tabulations', require('./components/non-clearance/create.vue'));
Vue.component('inbound-quote', require('./components/quote/inbound-create.vue'));
Vue.component('outbound-quote', require('./components/quote/outbound-create.vue'));
Vue.component('freight', require('./components/freight/create.vue'));
Vue.component('domestic-freight', require('./components/domestic-freight/create.vue'));
Vue.component('domestic-waybill-create', require('./components/domestic-waybill/Form.vue'));
Vue.component('outbound-freight', require('./components/outbound-freight/create.vue'));
Vue.component('outbound-additional-charge', require('./components/additional-charge/create.vue'));
Vue.component('assign-courier', require('./components/dispatch/assignment-modal.vue'));
Vue.component('recurrent-dates-set', require('./components/dispatch/recurrent-dates-modal.vue'));
Vue.component('loader', require('./components/core/loader.vue'));
//process POD
Vue.component('process-pod', require('./components/pod-scan/create.vue'));

const app = new Vue({
    el: '#app',
    data: {
        isLoading: false,
        csrf: window.Laravel.csrfToken
    }
});

function createForm(link) {
    var form =
        $('<form>', {
            'method': 'POST',
            'action': link.dataset.url
        });

    var token =
        $('<input>', {
            'type': 'hidden',
            'name': '_token',
            'value': link.dataset.token
        });

    var hiddenInput =
        $('<input>', {
            'name': '_method',
            'type': 'hidden',
            'value': 'delete'
        });

    return form.append(token, hiddenInput)
        .appendTo('body');
}

$(document).ready(() => {
    "use strict";
    confirm2('.btn-destroy', (element) => {
        let form = createForm(element);
        form.submit();
    });
    prepareTable();
    $('.datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
    });

    $('.selectpicker').selectpicker({
        style: 'btn-info',
        size: 'auto',
        liveSearch: true,
        liveSearchPlaceholder: 'Search...',
    });

});