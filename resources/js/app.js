import Vue from 'vue'
import App from './views/App.vue'
import VueRouter from 'vue-router'
import router from './routes.js'

Vue.use(VueRouter);
const app = new Vue({
    el: '#app',
    components: { App },
    router:router,
});
