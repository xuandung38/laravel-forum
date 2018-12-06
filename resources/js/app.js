/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

// import "vuetify/dist/vuetify.min.css";
// import "@fortawesome/fontawesome-free/css/all.css";

// import Vue from "vue";
// import Vuetify from "vuetify";
// import Vuei18n from 'vue-i18n'
// import Vuex from 'vuex';
// import VueRouter from 'vue-router';

// Vue.use(Vuetify, {
//     iconfont: "fa"
// });

// Vue.use(Vuei18n)
// Vue.use(Vuex);
// Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue")
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: "#app",

//     data: {
//         drawer: false,

//         windowSize: {
//             width: 0,
//             height: 0
//         }
//     },

//     methods: {
//         mounted() {
//             this.onResize();
//         },

//         onResize() {
//             this.windowSize.width = window.innerWidth;
//             this.windowSize.height = window.innerHeight;
//         }
//     },

//     computed: {
//         shouldExtendToolbar() {
//             return this.windowSize.width > 800;
//         }
//     }
// });
