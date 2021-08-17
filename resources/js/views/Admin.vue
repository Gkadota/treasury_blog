<template>
  <section class="mt-5">
    <div class="buttons">
      <b-button
        label="Delete Selected"
        type="is-danger"
        :disabled="!selected"
        :loading="isLoading"
        @click="deleteBlogger"
      />

      <b-button label="Edit Selected" type="is-info" @click="initEditPage" />
    </div>

    <b-tabs>
      <b-tab-item label="Users">
        <b-table
          :data="bloggers"
          :columns="columns"
          :selected.sync="selected"
          focusable
        >
        </b-table>
      </b-tab-item>
    </b-tabs>
  </section>
</template>

<script>
import api from "../api";
import { SnackbarProgrammatic as Snackbar } from "buefy";
export default {
  created() {
    this.getBloggers();
  },
  data() {
    return {
      bloggers: [],
      isLoading: false,
      selected: {},
      columns: [
        {
          field: "user_id",
          label: "ID",
          width: "40",
          numeric: true,
        },
        {
          field: "email",
          label: "Email",
        },
        {
          field: "first_name",
          label: "First Name",
        },
        {
          field: "last_name",
          label: "Last Name",
        },
        {
          field: "created_at",
          label: "Created at",
          centered: true,
        },
      ],
    };
  },

  methods: {
    initEditPage() {
      this.$router.push({
        name: "edit-admin",
        params: { id: this.selected.user_id , user: this.selected},
      });
    },
    async deleteBlogger() {
      if (!confirm("are you sure?")) return;

      this.isLoading = true;
      let response = await api.deleteBlogger(this.selected.user_id);

      this.isLoading = false;
      if (!response.success) {
        Snackbar.open({
          message: "Something went wrong",
          actionText: null,
          duration: 2000,
        });

        return;
      }

      Snackbar.open({
        message: "user deleted",
        actionText: null,
        duration: 2000,
      });

      this.getBloggers();
    },

    async getBloggers() {
      let response = await api.getBloggers();

      if (!response.success) {
        Snackbar.open({
          message: "Something went wrong",
          actionText: null,
          duration: 2000,
        });

        return;
      }

      let bloggers = response.data;
      let updatedBlogger = bloggers.map(
        ({ user_id, email, first_name, last_name, created_at }) => ({
          user_id,
          email,
          first_name,
          last_name,
          created_at,
        })
      );
      this.bloggers = response.data;
    },
  },
};
</script>
