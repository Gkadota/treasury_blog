<template>
  <div class="container">
    <h1 class="title has-text-centered mt-3">Create new blog</h1>

    <section >
      <b-field
        label="Title"
        :type="titleErrorState"
        :message="title.message[0]"
      >
        <b-input type="text" v-model="title.text" required> </b-input>
      </b-field>

      <b-field
        label="Details"
        :type="detailsErrorState"
        :message="details.message[0]"
      >
        <b-input type="textarea" v-model="details.text" required></b-input>
      </b-field>

      <b-field class="file is-primary" :class="{ 'has-name': !!img.file }">
        <b-upload v-model="img.file" class="file-label">
          <span class="file-cta">
            <b-icon class="file-icon" icon="upload"></b-icon>
            <span class="file-label">Click to upload</span>
          </span>
          <span class="file-name" v-if="img.file">
            {{ img.file.name }}
          </span>
        </b-upload>

        <p :class="imgErrorState">{{ img.message[0] }}</p>
      </b-field>

      <b-field label="Category">
        <b-select
          placeholder="Select a character"
          v-model="category.text"
          required
        >
          <option value="technology">Technology</option>
          <option value="finance">Finance</option>
          <option value="business">Business</option>
        </b-select>
      </b-field>

      <b-field position="is-centered">
        <b-input v-show="false"></b-input>
        <b-button type="is-primary" :loading="isLoading" @click="createBlog"
          >POST</b-button
        >
      </b-field>
    </section>
  </div>
</template>

<script>
import api from "../api";
import { SnackbarProgrammatic as Snackbar } from "buefy";
import { mapGetters } from "vuex";

export default {
  data() {
    return {
      title: { text: "", message: [] },
      details: { text: "", message: [] },
      category: { text: "technology", message: [] },
      img: { file: [], message: [] },
      isLoading: false,
    };
  },

  computed: {
    titleErrorState() {
      return this.title.message.length > 0 ? "is-danger" : "";
    },
    detailsErrorState() {
      return this.details.message.length > 0 ? "is-danger" : "";
    },
    imgErrorState() {
      return this.img.message.length > 0 ? "img-error" : "";
    },

    ...mapGetters(['getUserInfo']),
  },
  methods: {
    async createBlog() {
      this.isLoading = true;

      let formData = new FormData();
      formData.append("img", this.img.file);
      formData.append("title", this.title.text);
      formData.append("details", this.details.text);
      formData.append("category", this.category.text);
      formData.append("user_id", this.getUserInfo.user_id);

      let response = await api.createBlog(formData);

      this.validateResponse(response);
      this.isLoading = false;
    },

    validateResponse(response) {
      if (!response.success && response.data !== null) {
        this.title.message = response.data.title ?? [];
        this.details.message = response.data.details ?? [];
        this.category.message = response.data.category ?? [];
        this.img.message = response.data.img ?? [];
        return;
      }

      Snackbar.open({
        message: "Blog Created!",
        actionText: null,
        duration: 2000,
      });

       this.$router.push({ name: "blogs" });
    },
  },
};
</script>

<style scoped>
.img-error {
  display: block;
  font-size: 0.75rem;
  margin-top: 0.25rem;
  color: #f14668;
}
</style>
