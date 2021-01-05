require('./bootstrap');

import Vue from 'vue'
import store from './store';
import router from './router';

//MASTER COMPONENT
window.Vue = require("vue");
Vue.component("master", require("./commons/Master.vue").default);

//TOOLBOX
import Toolbox from './commons/toolbox';
Vue.use(Toolbox);

//UTILS
import utils from "./commons/utils";
Vue.use(utils);

//CKEDITOR
import CKEditor from "ckeditor4-vue";
Vue.use( CKEditor );

//ALERTIFY
import VueAlertify from 'vue-alertify'
Vue.use(VueAlertify);

const app = new Vue({
    el: '#app',
    store,
    router
});