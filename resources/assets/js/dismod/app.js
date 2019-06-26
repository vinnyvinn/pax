
window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest'
};

window.Vue = require('vue');

Vue.component('customer-form', require('./components/customer/Form.vue'));
Vue.component('customer-select', require('./components/customer/Select.vue'));

const app = new Vue({
    el: '#app'
});
