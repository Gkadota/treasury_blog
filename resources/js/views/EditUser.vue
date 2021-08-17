<template>
  <div class="mt-6">
    <div class="columns">
      <div class="column is-centered is-one-half">
        <section class="box container">
          <h1 class="title reg-title">Update User</h1>

          <b-field
            label="First Name"
            label-position="on-border"
            :type="firstNameErrorState"
            :message="firstName.message[0]"
          >
            <b-input type="text" v-model="firstName.text"> </b-input>
          </b-field>

          <b-field
            label="Last Name"
            label-position="on-border"
            :type="lastNameErrorState"
            :message="lastName.message[0]"
          >
            <b-input type="text" v-model="lastName.text"> </b-input>
          </b-field>

          <b-field
            label="Email"
            label-position="on-border"
            :type="emailErrorState"
            :message="email.message[0]"
          >
            <b-input type="email" v-model="email.text"> </b-input>
          </b-field>

          <b-field
            label="Password"
            label-position="on-border"
            :type="passwordErrorState"
            :message="password.message[0]"
          >
            <b-input type="password" v-model="password.text" password-reveal>
            </b-input>
          </b-field>

          <b-field
            label="Confirm Password"
            label-position="on-border"
            :type="conPassErrorState"
            :message="confirmPass.message[0]"
          >
            <b-input type="password" password-reveal v-model="confirmPass.text">
            </b-input>
          </b-field>

          <b-field position="is-centered">
            <b-input v-show="false"></b-input>
            <b-button
              type="is-warning"
              @click="updateUser"
              rounded
              :loading="isLoading"
              >Update</b-button
            >
          </b-field>
        </section>
      </div>
    </div>
  </div>
</template>

<script>
import Divider from "../components/Divider";
import api from "../api.js";
import { SnackbarProgrammatic as Snackbar } from "buefy";
import _ from 'lodash';
export default {
  name: "EditUser",
  created() {
    this.initUserData();
  },
  data() {
    return {
      user_id: null,
      firstName: { text: "", message: [] },
      lastName: { text: "", message: [] },
      email: { text: "", message: [] },
      password: { text: "", message: [] },
      confirmPass: { text: "", message: [] },
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
    initUserData() {
      let user = this.$route.params.user;
      this.user_id = this.$route.params.id;
      this.firstName.text = user.first_name;
      this.lastName.text = user.last_name;
      this.email.text = user.email;
    },
    async updateUser() {
      if (!this.validatePassword()) return;
      this.isLoading = true;
      let userInfo = {
        user_id: this.user_id,
        first_name: this.firstName.text,
        last_name: this.lastName.text,
        email: this.email.text,
        password: this.password.text,
      };
      userInfo = _.pickBy(userInfo);
      let response = await api.editBlogger(userInfo);
      this.isLoading = false;

      this.validateResponse(response);
    },

    validateResponse(response) {
      if (!response.success && response.data !== null) {
        this.firstName.message = response.data.first_name ?? [];
        this.lastName.message = response.data.last_name ?? [];
        this.email.message = response.data.email ?? [];
        this.password.message = response.data.password ?? [];
        return;
      }

      Snackbar.open({
        message: "Update Success",
        actionText: null,
        duration: 2000,
      });

      this.$router.push({ name: "admin" });
    },

    validatePassword() {
      if (
        (this.password.text !== null || this.password.text !== "") &&
        this.password.text !== this.confirmPass.text
      ) {
        this.confirmPass.message = ["Password confirmation does not match"];
        return false;
      }

      return true;
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

