import Vue from 'vue'
import Vuex from 'vuex'


Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        isLogin: false,
        isLoading: false,
    },
    getters: {
        getLoginStatus: state => state.isLogin,
        getLoadingStatus: state => state.isLoading,
    },

    mutations: {
        setLoading: (state, { isLoading }) => setLoader(state, isLoading),
        setLoginStatus: (state, { isLogin }) => state.isLogin = isLogin,
    }
});

const setLoader = (state, isLoading) => state.isLoading = isLoading;
export default store;
