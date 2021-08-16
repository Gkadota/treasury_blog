<template>
  <div>
    <div
      class="message is-light"
      v-for="comment in comments"
      :key="comment.comment_id"
    >
      <div class="message-header">
        {{comment.user.first_name }} {{comment.user.last_name}}
        <p class="is-size-7 has-text-right"><i>{{moment(comment.created_at).format("MMMM Do YYYY")}}</i></p>
      </div>
      <div class="message-body">
        {{comment.comments}}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  props: {
    comments: Object | Array,
  },
};
</script>

<style>
</style>
