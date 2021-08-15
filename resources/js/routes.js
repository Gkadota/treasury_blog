import VueRouter from 'vue-router'
import Register from './views/Register.vue'
import Login from './views/Login.vue'
import Blogs from './views/Blogs.vue'
import BlogView from './views/BlogView.vue'
import Home from './views/Home.vue'
import store from "./store/index";
const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/blogs',
            name: 'blogs',
            component: Blogs,
            meta: { requiredAuth: true },
        },

        {
            path: '/blog/:id',
            name: 'blog-view',
            component: BlogView,
            meta: { requiredAuth: true },
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

/**
 * Before guard router
 */
router.beforeEach((to, from, next) => {

    if (to.meta.requiredAuth === true) {
        if (store.getters.getLoginStatus === false) {
            next({ name: 'home' });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
