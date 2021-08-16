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
            { user_type: 'blogger', ...bloggerInfo },
        );
        return data;
    }

    /**
   * View Blog list
   */
    async getBlogList(category = null, searchQuery = null) {
        let { data } = await Vue.axios.get(
            `${this.baseUrl}/blog/list`,
            { params: { category: category, search: searchQuery } },
        );
        return data;
    }


   /**
    *  View Blog
    * @param {*} blogId
    * @returns
    */
    async getBlog(blogId) {
        let { data } = await Vue.axios.get(
            `${this.baseUrl}/blog/${blogId}`,
        );
        return data;
    }



      /**
       * Create new blog
       * @param {*} blogInfo
       * @returns
       */
       async createBlog(blogInfo) {
        let { data } = await Vue.axios.post(
            `${this.baseUrl}/blog`,
            blogInfo,
            {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            }
        );
        return data;
    }


    /**
       * Update  blog
       * @param {*} blogInfo
       * @returns
       */
     async updateBlog(blogInfo) {
        let { data } = await Vue.axios.post(
            `${this.baseUrl}/blog/edit`,
            blogInfo,
            {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            }
        );
        return data;
    }


    /**
     *  Delete Blog
     * @param {*} blogId
     * @param {*} userId
     * @returns
     */
    async deleteBlog(blogId, userId) {
        let { data } = await Vue.axios.delete(
            `${this.baseUrl}/blog`,
           {params: { blog_id: blogId, user_id: userId }}
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

    /**
    * Logout User
    */
    async logout(logoutInfo) {
        let { data } = await Vue.axios.post(
            `${this.baseUrl}/user/logout`,
            logoutInfo,
        );
        return data;
    }


    /**
     * Create comment
     */
     async createComment(userId, blogId, comments) {
        let { data } = await Vue.axios.post(
            `${this.baseUrl}/comment`,
            {
                user_id: userId,
                blog_id: blogId,
                comments:comments,
            },
        );
        return data;
    }



}


export default new api();

