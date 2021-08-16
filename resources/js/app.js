import Vue from 'vue'
import App from './views/App.vue'
import VueRouter from 'vue-router'
import router from './routes.js'
import store from './store/index.js'
import axios from 'axios'
import VueAxios from 'vue-axios';
import Buefy from 'buefy'
import 'buefy/dist/buefy.css'
import moment from 'moment'



// icons
import { library } from '@fortawesome/fontawesome-svg-core';
// internal icons
import {
    faCheck, faCheckCircle, faInfoCircle, faExclamationTriangle, faExclamationCircle,
    faArrowUp, faAngleRight, faAngleLeft, faAngleDown,
    faEye, faEyeSlash, faCaretDown, faCaretUp, faUpload
} from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(faCheck, faCheckCircle, faInfoCircle, faExclamationTriangle, faExclamationCircle,
    faArrowUp, faAngleRight, faAngleLeft, faAngleDown,
    faEye, faEyeSlash, faCaretDown, faCaretUp, faUpload);

Vue.component('vue-fontawesome', FontAwesomeIcon);

Vue.use(Buefy, {
    defaultIconComponent: 'vue-fontawesome',
    defaultIconPack: 'fas',
});

Vue.prototype.moment = moment

Vue.use(VueAxios, axios);
Vue.use(VueRouter);
const app = new Vue({
    el: '#app',
    components: { App },
    router: router,
    store
});
