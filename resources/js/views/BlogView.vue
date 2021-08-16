<template>
  <div class="container mt-6 mb-6">
    <h1 class="title">{{ blog.title }}</h1>

    <div class="sub-title">
      {{ moment(blog.created_at).format("MMMM Do YYYY") }}
    </div>

    <div class="card">
      <div class="card-image">
        <figure class="image is-3by2">
          <img :src="'../storage/' + blog.img" alt="Placeholder image" />
        </figure>
      </div>
    </div>

    <p class="mt-4">
      {{ blog.details }}
    </p>
    <div class="buttons is-centered" v-if="isMyBlog">
      <router-link class="button is-dark" :to="'/blog/edit/' + blogId"
        >Edit</router-link
      >
      <b-button
        type="is-danger is-outlined"
        :loading="isLoading"
        @click="deleteBlog"
      >
        Delete
      </b-button>
    </div>
    <!-- COMMENT SECTION -->
    <hr />
    <div class="container box mt-3">
      <b-field
        position="is-left"
        horizontal
        label="Comment here: "
        :type="commentErrorState"
        :message="newComment.message[0]"
      >
        <b-input type="textarea" v-model="newComment.text" required></b-input>
      </b-field>

      <b-field horizontal
        ><!-- Label left empty for spacing -->
        <p class="control">
          <b-button
            label="Comment"
            type="is-warning "
            :loading="isCommentLoading"
            @click="createComment"
          />
        </p>
      </b-field>

      <CommentList :comments="comments" />
    </div>
  </div>
</template>

<script>
import api from "../api";
import { SnackbarProgrammatic as Snackbar } from "buefy";
import CommentList from "../components/CommentList.vue";
import { mapGetters } from "vuex";
export default {
  components: {
    CommentList,
  },
  created() {
    this.blogId = this.$route.params.id;
    this.getBlogDetails();
  },
  data() {
    return {
      blogId: null,
      blog: {},
      comments: [],
      newComment: { text: null, message: [] },
      isLoading: false,
      isCommentLoading: false,
    };
  },

  computed: {
    isMyBlog() {
      return this.getUserInfo.user_id === this.blog.user_id;
    },
    commentErrorState() {
      return this.newComment.message.length > 0 ? "is-danger" : "";
    },
    ...mapGetters(["getUserInfo", "getLoginStatus"]),
  },

  methods: {
    async createComment() {
      if (this.getLoginStatus === false) {
        Snackbar.open({
          message: "You must log in first",
          actionText: 'ok',
          duration: 2000,
        });
        return false;
      }
      this.isCommentLoading = true;
      let response = await api.createComment(
        this.getUserInfo.user_id,
        this.blogId,
        this.newComment.text
      );

      this.isCommentLoading = false;

      if (!response.success) {
        this.newComment.message = response.data.comments ?? [];
        return;
      }

      Snackbar.open({
        message: "Comment posted",
        actionText: null,
        duration: 2000,
      });
      this.newComment.message = [];
      this.getBlogDetails();
    },

    async deleteBlog() {
      if (!confirm("Do you really want to delete this?")) return;

      this.isLoading = true;
      let response = await api.deleteBlog(
        this.blogId,
        this.getUserInfo.user_id
      );

      this.isLoading = false;

      if (!this.validateBlogResponse(response)) return;

      Snackbar.open({
        message: "Blog deleted",
        actionText: null,
        duration: 2000,
      });

      this.$router.push({ name: "blogs" });
    },

    async getBlogDetails() {
      let response = await api.getBlog(this.blogId);

      if (!this.validateBlogResponse(response)) return;
      this.blog = response.data;
      this.comments = response.data.comments;
    },

    validateBlogResponse(response) {
      if (!response.success) {
        Snackbar.open({
          message: "Something went wrong. Please try again",
          actionText: null,
          duration: 2000,
        });

        return false;
      }

      return true;
    },
  },
};
</script>

<style scoped>
</style>
