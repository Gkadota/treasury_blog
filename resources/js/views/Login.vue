<template>
  <div>
    <div class="columns">
      <div class="column is-one-third">
        <!-- Login form -->
        <section id="login-form">
          <h1 class="title login-title">Login to Tblog</h1>
          <h2 class="sub-title login-title">
            Don't have an account?
            <router-link class="is-light" :to="{ name: 'register' }"
              >Register</router-link
            >
          </h2>
          <b-field
            label="Email"
            :type="emailErrorState"
            :message="email.message[0]"
          >
            <b-input type="email" v-model="email.text" required> </b-input>
          </b-field>

          <b-field
            label="Password"
            :type="passwordErrorState"
            :message="password.message[0]"
          >
            <b-input type="password" v-model="password.text" password-reveal required>
            </b-input>
          </b-field>


          <b-field position="is-centered">
            <b-input v-show="false"></b-input>
            <b-button
              type="is-warning"
              rounded
              :loading="isLoading"
              @click="loginUser"
              >Sign In</b-button
            >
          </b-field>
        </section>
      </div>
      <Divider />
    </div>
  </div>
</template>

<script>
import Divider from "../components/Divider";
import api from "../api";
import { SnackbarProgrammatic as Snackbar } from "buefy";
import { mapGetters, mapMutations } from "vuex";

export default {
  name: "Login",
  components: {
    Divider,
  },

  data() {
    return {
      email: { text: null, message: [] },
      password: { text: null, message: [] },
      isLoading: false,
    };
  },
  computed: {
    emailErrorState() {
      return this.email.message.length > 0 ? "is-danger" : "";
    },

    passwordErrorState() {
      return this.password.message.length > 0 ? "is-danger" : "";
    },

    ...mapGetters(["getLoginStatus", 'getUserInfo']),
  },
  methods: {
    async loginUser() {
      this.isLoading = true;

      let loginResponse = await api.login({
        email: this.email.text,
        password: this.password.text,
      });

      this.validateLoginResponse(loginResponse);
      this.isLoading = false;
    },

    validateLoginResponse(response) {
      if (!response.success) {
        this.email.message = ["Incorrect email/password."];
        return;
      }

      this.setLoginStatus({ isLogin: true });
      this.setUserInfo({userInfo: response.data});

      Snackbar.open({
        message: "Login successfully",
        actionText: null,
        duration: 2000,
      });

      let routeDirection = this.getUserInfo.user_type === 'admin' ? 'admin' : 'blogs' ;
      this.$router.push({ name: routeDirection });
    },

    ...mapMutations(["setLoginStatus", 'setUserInfo']),
  },
};
</script>

<style scoped>
#login-form {
  margin: 120px 30px 120px 63px;
}

.login-title {
  text-align: center;
}
</style>

