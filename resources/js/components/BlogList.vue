<template>
  <div class="columns is-multiline">
    <div class="column is-4" v-for="blog in blogList" :key="blog.blog_id">
      <div class="card blog-card">
        <div class="card-image">
          <figure class="image is-4by3">
            <img :src="'../storage/' + blog.img" alt="Placeholder image" />
          </figure>
        </div>
        <div class="card-content">
          <div class="media">
            <div class="media-content">
              <p class="title is-5">{{ blog.title }}</p>
              <p class="subtitle is-6">by {{ blog.blogger.first_name }}</p>
            </div>
          </div>

          <!-- <div class="content">
            <br />

            <time datetime="2016-1-1">
              {{
                blog.created_at.substr(0, blog.created_at.indexOf(" "))
              }}</time
            >
          </div> -->
        </div>

        <footer class="card-footer">
          <p class="card-footer-item">
            <span>
              <router-link
                class="button is-warning"
                :to="'/blog/' + blog.blog_id"
                >View post</router-link
              >
            </span>
          </p>
        </footer>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "BlogsList",
  props: {
    blogList: Object | Array,
  },
};
</script>

<style scoped>
.blog-card:hover {
  transform: scale(1.04);
  box-shadow: 0 4px 6px -1px rgb(0 0 0 / 35%), 0 2px 4px -1px rgb(0 0 0 / 6%);
}

.blog-card {
  transition: all 0.5s ease;
}
</style>
