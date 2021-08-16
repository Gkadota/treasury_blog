import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import api from '../api';

Vue.use(Vuex);

const store = new Vuex.Store({
    plugins: [createPersistedState({
        storage: window.sessionStorage,
    })],
    state: {
        isLogin: false,
        isLoading: false,
        userInfo: {
            user_id: null,
            first_name: null,
            last_name: null,
            email: null,
            user_type: null,
        },

    },
    getters: {
        getLoginStatus: state => state.isLogin,
        getLoadingStatus: state => state.isLoading,
        getUserInfo: state => state.userInfo,
    },

    mutations: {
        setLoading: (state, { isLoading }) => setLoader(state, isLoading),
        setLoginStatus: (state, { isLogin }) => state.isLogin = isLogin,
        setUserInfo: (state, { userInfo }) => state.userInfo = userInfo,
    },


});

const setLoader = (state, isLoading) => state.isLoading = isLoading;
export default store;
