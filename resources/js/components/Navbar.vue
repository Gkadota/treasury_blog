<template>
  <b-navbar type="is-light">
    <template #brand>
      <b-navbar-item tag="router-link" :to="{ name: 'home' }">
        <p id="logo">TBLOGS</p>
      </b-navbar-item>
    </template>

    <template #end>
      <b-navbar-item tag="div">
          <p class="sub-title  mr-2" v-if="getLoginStatus=== true"> Hi,<b> {{getUserInfo.first_name}}</b> </p>
        <div class="buttons">

          <router-link
            class="button is-primary"
            :to="{ name: 'create-blog' }"
            v-if="getLoginStatus"
            >Create New Blog</router-link
          >
          <router-link class="button is-primary" :to="{ name: 'blogs' }"
            >Blogs</router-link
          >
          <router-link
            v-if="!getLoginStatus"
            class="button is-warning"
            :to="{ name: 'login' }"
            >Login</router-link
          >

          <b-button
            v-if="getLoginStatus"
            class="is-danger is-outlined"
            :loading="isLoading"
            @click="logoutUser"
          >
            Logout</b-button
          >

          <router-link
            v-if="!getLoginStatus"
            class="button is-light"
            :to="{ name: 'register' }"
            >Register</router-link
          >
        </div>
      </b-navbar-item>
    </template>
  </b-navbar>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
import api from "../api";
import { SnackbarProgrammatic as Snackbar } from "buefy";
export default {
  name: "Login",
  data() {
    return {
      isLoading: false,
    };
  },
  computed: {
    ...mapGetters(['getLoginStatus', 'getUserInfo']),
  },

  methods: {
    async logoutUser() {
      //TODO: make a logout function
      this.isLoading = true;

      let logoutResponse = await api.logout({
        email: this.getUserInfo.email,
      });

      if (logoutResponse.success) {
        sessionStorage.clear();
        this.setLoginStatus({ isLogin: false });
        this.setUserInfo({ userInfo: {} });
        this.$router.push({ name: "home" });
      } else {

        Snackbar.open({
          message: "Something went wrong. Please try again",
          actionText: null,
          duration: 2000,
        });

      }

      this.isLoading = false;
    },

    ...mapMutations(["setLoginStatus", 'setUserInfo']),
  },
};
</script>

<style>
#logo {
  color: peru;
  font-size: 25px;
  font-weight: 900;
  font-family: Quicksand, sans-serif;
}
</style>
