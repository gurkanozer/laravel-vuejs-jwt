require('../bootstrap');
window.Vue = require("vue");
Vue.component("test-button", require("./components/TestButton").default);
Vue.component("navbar-component", require("./components/NavbarComponent").default);

const app = new Vue({
    el: '#app',
});