import VueRouter from 'vue-router'
import Register from './views/Regiter.vue'
import Home from './views/Home.vue'
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/register',
            name: 'register',
            component: Register,
        },
    ],
});



export default router;
