import Vue from 'vue';

class api {
    constructor() {
        this.baseUrl = '/api';
    }


    /**
     * Register Blogger
     */
    async registerBlogger(bloggerInfo) {
        let { data } = await Vue.axios.post(
            `${this.baseUrl}/user`,
            {user_type:'blogger',...bloggerInfo},
        );
        return data;
    }


    /**
     * Login User
     */
     async login(loginInfo) {
        let { data } = await Vue.axios.post(
            `${this.baseUrl}/user/login`,
            loginInfo,
        );
        return data;
    }
}


export default new api();

