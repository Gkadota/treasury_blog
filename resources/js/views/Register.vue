<template>
  <div>
    <div class="columns">
      <div class="column is-one-third">
        <!-- Register form -->
        <section id="reg-form">
          <h2 class="sub-title reg-title">
            Already have an account?
            <router-link class="is-light" :to="{ name: 'login' }"
              >Login</router-link
            >
          </h2>
          <h1 class="title reg-title">Create your account on <b>Tblog</b></h1>

          <b-field
            label="First Name"
            label-position="on-border"
            :type="firstNameErrorState"
            :message="firstName.message[0]"
          >
            <b-input type="text" v-model="firstName.text" required> </b-input>
          </b-field>

          <b-field
            label="Last Name"
            label-position="on-border"
            :type="lastNameErrorState"
            :message="lastName.message[0]"
          >
            <b-input type="text" v-model="lastName.text" required> </b-input>
          </b-field>

          <b-field
            label="Email"
            label-position="on-border"
            :type="emailErrorState"
            :message="email.message[0]"
          >
            <b-input type="email" v-model="email.text" required> </b-input>
          </b-field>

          <b-field
            label="Password"
            label-position="on-border"
            :type="passwordErrorState"
            :message="password.message[0]"
          >
            <b-input
              type="password"
              v-model="password.text"
              password-reveal
              required
            >
            </b-input>
          </b-field>

          <b-field
            label="Confirm Password"
            label-position="on-border"
            :type="conPassErrorState"
            :message="confirmPass.message[0]"
          >
            <b-input
              type="password"
              password-reveal
              v-model="confirmPass.text"
              required
            >
            </b-input>
          </b-field>

          <b-field position="is-centered">
            <b-input v-show="false"></b-input>
            <b-button
              type="is-warning"
              @click="register"
              rounded
              :loading="isLoading"
              >Register</b-button
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
import api from "../api.js";
import { SnackbarProgrammatic as Snackbar } from "buefy";

export default {
  name: "Register",
  components: {
    Divider,
  },

  data() {
    return {
      firstName: { text: null, message: [] },
      lastName: { text: null, message: [] },
      email: { text: null, message: [] },
      password: { text: null, message: [] },
      confirmPass: { text: null, message: [] },
      isLoading: false,
    };
  },

  computed: {
    firstNameErrorState() {
      return this.firstName.message.length > 0 ? "is-danger" : "";
    },

    lastNameErrorState() {
      return this.lastName.message.length > 0 ? "is-danger" : "";
    },

    emailErrorState() {
      return this.email.message.length > 0 ? "is-danger" : "";
    },

    passwordErrorState() {
      return this.password.message.length > 0 ? "is-danger" : "";
    },

    conPassErrorState() {
      return this.confirmPass.message.length > 0 ? "is-danger" : "";
    },
  },

  methods: {
    async register() {
      this.validatePassword();
      this.isLoading = true;

      let response = await api.registerBlogger({
        first_name: this.firstName.text,
        last_name: this.lastName.text,
        email: this.email.text,
        password: this.password.text,
      });
      this.isLoading = false;

      this.validateResponse(response);
    },

    validateResponse(response) {

      if (!response.success) {
        this.firstName.message = response.data.first_name ?? [];
        this.lastName.message = response.data.last_name ?? [];
        this.email.message = response.data.email ?? [];
        this.password.message = response.data.password ?? [];
        return;
      }

      Snackbar.open({
        message: "Successfully registered",
        actionText: null,
        duration: 2000,
      });
      this.$router.push({ name: "login" });
    },

    validatePassword() {
      if (this.password.text !== this.confirmPass.text) {
        this.confirmPass.message = ["Password confirmation does not match"];
      }
    },
  },
};
</script>

<style scoped>
#reg-form {
  margin: 78px 44px 30px 54px;
}
.sub-title {
  margin-bottom: 20px;
}

.title {
  margin-bottom: 30px;
}

.reg-title {
  text-align: center;
}
</style>

