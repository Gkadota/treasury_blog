import VueRouter from 'vue-router'
import Register from './views/Register.vue'
import Login from './views/Login.vue'
import Blogs from './views/Blogs.vue'
import BlogView from './views/BlogView.vue'
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
            path: '/blogs',
            name: 'blogs',
            component: Blogs,
        },

        {
            path: '/blog/view',
            name: 'blog-view',
            component: BlogView,
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
