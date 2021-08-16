<template>
  <div>
    <div
      class="message is-light"
      v-for="comment in comments"
      :key="comment.comment_id"
    >
      <div class="message-header">
        {{ comment.user.first_name }} {{ comment.user.last_name }}

        <div class="buttons" v-if="isMyComment">
          <b-button
            type="is-light"
            @click="selectToEdit(comment.comment_id, comment.comments)"
          >
            Edit
          </b-button>
          <b-button
            type="is-danger is-outlined"
            @click="deleteComment(comment.comment_id, comment.blog_id)"
          >
            Delete
          </b-button>
        </div>
        <p class="is-size-7 has-text-right">
          <i>{{ moment(comment.created_at).format("MMMM Do YYYY") }}</i>
        </p>
      </div>
      <div class="message-body">
        <p>{{ comment.comments }}</p>

        <!-- EDIT COMMENT -->
        <div class="container" v-if="isOnEditMode(comment.comment_id)">
          <b-field
            position="is-left"
            horizontal
            label="Edit Comment: "
            @click="updateComment(commentId)"
          >
            <b-input type="textarea" required v-model="commentToEdit"></b-input>
          </b-field>

          <b-field horizontal
            ><!-- Label left empty for spacing -->
            <p class="control">
              <b-button
                label="Update Comment"
                type="is-warning "
                @click="updateComment(comment.comment_id)"
              />
              <b-button
                label="Cancel"
                @click="selectToEdit(null)"
                type="is-light "
              />
            </p>
          </b-field>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import api from "../api";
import { SnackbarProgrammatic as Snackbar } from "buefy";
export default {
  data() {
    return {
      commentIdOnEdit: null,
      commentToEdit: null,
    };
  },
  methods: {
    selectToEdit(commentId, comment = null) {
      this.commentIdOnEdit = commentId;
      this.commentToEdit = comment;
    },

    isOnEditMode(commentId) {
      return this.commentIdOnEdit === commentId;
    },
    isMyComment(userId) {
      return this.getUserInfo.user_id === userId;
    },

    async updateComment(commentId) {
      let response = await api.updateComment(commentId, this.commentToEdit);

      if (!response.success) {
        Snackbar.open({
          message: "Something went wrong. Please try again",
          actionText: null,
          duration: 2000,
        });

        return false;
      }

      Snackbar.open({
        message: "Comment updated",
        actionText: null,
        duration: 2000,
      });

      let foundIndex = this.comments.findIndex(
        (comment) => comment.comment_id === commentId
      );
      let commentToUpdate = this.comments[foundIndex];
      commentToUpdate.comments = this.commentToEdit;
      this.comments[foundIndex] = commentToUpdate;

      this.commentIdOnEdit = null;
    },

    async deleteComment(commentId, blogId) {
      if (!confirm("Do you really want to delete this?")) return;

      let response = await api.deleteComment(commentId);

      if (!response.success) {
        Snackbar.open({
          message: "Something went wrong. Please try again",
          actionText: null,
          duration: 2000,
        });

        return false;
      }

      Snackbar.open({
        message: "Comment deleted",
        actionText: null,
        duration: 2000,
      });

      let index = this.comments
        .map(function (item) {
          return item.comment_id;
        })
        .indexOf(commentId);

      this.comments.splice(index, 1);
    },
  },
  computed: {
    ...mapGetters(["getUserInfo"]),
  },
  props: {
    comments: Object | Array,
  },
};
</script>

<style>
</style>
