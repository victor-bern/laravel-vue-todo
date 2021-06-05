<template>
  <layout>
    <inertia-head title="Register" />
    <div class="container">
      <form>
        <span>Register</span>

        <md-field>
          <label for="name">Name</label>
          <md-input
            v-model="login.name"
            name="name"
            id="name"
            autocomplete="given-name"
          />
        </md-field>
        <md-field>
          <label for="email">Email</label>
          <md-input
            type="email"
            v-model="login.email"
            name="email"
            id="email"
            autocomplete="given-name"
          />
        </md-field>
        <md-field>
          <label for="password">Password</label>
          <md-input
            v-model="login.password"
            name="password"
            type="password"
            id="password"
            autocomplete="given-name"
          />
        </md-field>
        <md-button
          v-on:click.prevent="register"
          class="md-dense md-raised md-primary"
          >Login</md-button
        >
      </form>
    </div>
    <md-snackbar
      md-position="center"
      :md-duration="mdDuration"
      :md-active.sync="existError"
      md-persistent
    >
      <span>{{ errorMessage }}</span>
    </md-snackbar>
  </layout>
</template>

<script>
import Layout from "../Layout.vue";
import { doRegister } from "../Services/appServices/authService";
export default {
  data() {
    return {
      mdDuration: 2000,
      existError: false,
      errorMessage: "",
      login: {
        name: "",
        email: "",
        password: "",
      },
    };
  },
  methods: {
    register: async function () {
      const response = await doRegister({
        name: this.login.name,
        email: this.login.email,
        password: this.login.password,
      });
      console.log(response);
      if (!response.sucess) {
        this.existError = true;
        this.errorMessage = response.Erro;
        return;
      }
      window.localStorage.setItem("user_token", response.user_token);
      window.localStorage.setItem("user_id", response.user_id);
      window.location.href = "/";
    },
  },
  components: { Layout },
  beforeMount() {
    const token = window.localStorage.getItem("user_token");
    if (token) {
      this.$inertia.get("/");
    }
  },
};
</script>

<style>
</style>

<style scoped>
.container {
  max-width: 100%;
  min-height: 90vh;
  display: flex;
  align-items: center;
  justify-content: center;
}
.container form {
  width: 390px;
  height: 390px;
  padding: 10px;
  display: flex;
  align-items: center;
  flex-direction: column;
}

form span {
  font-family: "Ubuntu", sans-serif;
  font-size: 50px;
  padding: 32px;
}

form button {
  width: 100%;
}
</style>
