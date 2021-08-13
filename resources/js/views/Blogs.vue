<template>
  <div>
    <div id="blog-header" class="container is-centered">
        <h1 class="title has-text-centered">Find some blogs here!</h1>
      <!-- TABS -->
      <div class="tabs is-toggle is-centered">
        <ul>
          <li class="is-active">
            <a>
              <span>All</span>
            </a>
          </li>
          <li>
            <a>
              <span class="icon is-small"
                ><i class="fas fa-music" aria-hidden="true"></i
              ></span>
              <span>Technology</span>
            </a>
          </li>
          <li>
            <a>
              <span class="icon is-small"
                ><i class="fas fa-film" aria-hidden="true"></i
              ></span>
              <span>Finance</span>
            </a>
          </li>
          <li>
            <a>
              <span class="icon is-small"
                ><i class="far fa-file-alt" aria-hidden="true"></i
              ></span>
              <span>Bunsiness</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- TABS END -->
      <section>
        <b-field position="is-centered">
          <b-input placeholder="Search..." type="search" icon="magnify">
          </b-input>
          <p class="control">
            <b-button type="is-primary" label="Search" />
          </p>
        </b-field>
      </section>
    </div>

    <div class="container">
      <BlogList />
    </div>
  </div>
</template>

<script>
import BlogList from "../components/BlogList";

export default {
  name: "Blogs",
  components: {
    BlogList,
  },
};
</script>

<style scoped>
#blog-header {
  margin-bottom: 70px;
  margin-top: 30px;
}
</style>
