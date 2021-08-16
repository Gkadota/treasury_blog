import VueRouter from 'vue-router'
import Register from './views/Register.vue'
import Login from './views/Login.vue'
import Blogs from './views/Blogs.vue'
import BlogView from './views/BlogView.vue'
import CreateBlog from './views/CreateBlog.vue'
import EditBlog from './views/EditBlog.vue'
import Admin from './views/Admin.vue'
import Home from './views/Home.vue'
import EditAdmin from './views/EditAdmin.vue'
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
        },
        {
            path: '/blog/edit/:id',
            name: 'edit-blog',
            component: EditBlog,
            meta: { requiredAuth: true },
        },
        {
            path: '/blog/create',
            name: 'create-blog',
            component: CreateBlog,
            meta: { requiredAuth: true },
        },
        {
            path: '/blog/:id',
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

        {
            path: '/admin',
            name: 'admin',
            component: Admin,
            meta: { requiredAdmin: true },
        },

        {
            path: '/admin/edit/:id',
            name: 'edit-admin',
            component: EditAdmin,
            meta: { requiredAdmin: true },
        },

    ],
});

/**
 * Before guard router
 */
router.beforeEach((to, from, next) => {
    if (to.meta.requiredAdmin === true) {
        if (store.getters.getUserInfo.user_type !== 'admin') {
            next({ name: 'blogs' });
        } else {
            next();
        }
    }
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
