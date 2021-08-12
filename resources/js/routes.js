import VueRouter from 'vue-router'
import Register from './views/Register.vue'
import Login from './views/Login.vue'
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
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
    ],
});



export default router;
