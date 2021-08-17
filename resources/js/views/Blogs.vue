<template>
  <div>
    <div id="blog-header" class="container is-centered">
      <h1 class="title has-text-centered">Find some blogs here!</h1>
      <!-- TABS -->
      <div class="tabs is-toggle is-centered">
        <ul>
          <li :class="activeAllTab">
            <a @click.prevent="selectTab('all')">
              <span>All</span>
            </a>
          </li>

          <li :class="activeTechTab">
            <a @click.prevent="selectTab('technology')">
              <span>Technology</span>
            </a>
          </li>

          <li :class="activeFinanceTab">
            <a @click.prevent="selectTab('finance')">
              <span>Finance</span>
            </a>
          </li>

          <li :class="activeBusinessTab">
            <a @click.prevent="selectTab('business')">
              <span>Business</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- TABS END -->
      <section>
        <b-field position="is-centered">
          <b-input placeholder="Search..." v-model="searchQuery" type="search">
          </b-input>
          <p class="control">
            <b-button
              label="Search"
              type="is-primary"
              @click="displayBlogList"
            />
          </p>
        </b-field>
      </section>
    </div>

    <div class="container">
         <b-loading  v-model="isLoading" ></b-loading>
      <BlogList :blog-list="blogList" />
    </div>
  </div>
</template>

<script>
import BlogList from "../components/BlogList";
import api from "../api";
import { SnackbarProgrammatic as Snackbar } from "buefy";
export default {
  name: "Blogs",
  components: {
    BlogList,
  },

  created() {
    this.selectTab("all");
  },
  data() {
    return {
      searchQuery: "",
      selectedTab: "all",
      blogList: {},
      isLoading:false,
    };
  },

  computed: {
    activeAllTab() {
      return this.selectedTab === "all" ? "is-active" : "";
    },

    activeFinanceTab() {
      return this.selectedTab === "finance" ? "is-active" : "";
    },

    activeTechTab() {
      return this.selectedTab === "technology" ? "is-active" : "";
    },

    activeBusinessTab() {
      return this.selectedTab === "business" ? "is-active" : "";
    },
  },
  methods: {
    async selectTab(selectedTab) {
      this.selectedTab = selectedTab;
      await this.displayBlogList();
    },
    async displayBlogList() {
        this.isLoading = true;
      let category = this.selectedTab !== "all" ? this.selectedTab : "";
      let response = await api.getBlogList(category, this.searchQuery);
    this.isLoading = false;
      if (!response.success) {
        Snackbar.open({
          message: "Something went wrong",
          actionText: null,
          duration: 2000,
        });

        return;
      }
      console.log(response);
      this.blogList = response.data;
    },
  },
};
</script>

<style scoped>
#blog-header {
  margin-bottom: 70px;
  margin-top: 30px;
}
</style>
