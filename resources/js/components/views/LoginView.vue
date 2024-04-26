<template>
  <div class="login">
    <div class="form">
      <div class="box-title">
        <h1>Login</h1>
      </div>
      <form class="login-form" @submit.prevent="login">
        <input type="email" name="email" placeholder="email" v-model="email" required />
        <input type="password" name="password" placeholder="password" v-model="password" required />
        <button type="submit">Connection</button>
        <p class="mt-2 text-center">Don't have an account? <router-link to="/register">Register</router-link></p>
        <p v-if="error" class="error-message mt-3">⛔ {{ error }} </p>
      </form>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
export default {
  name: "LoginView",
  data() {
    return {
      email: "",
      password: "",
      error: "",
    };
  },
  created() {
    const token = localStorage.getItem("token");
    if (token) {
      this.$router.push("/");
    }
  },
  methods: {
    async login() {
      const url = '/api/login'; // Assuming your baseURL is set correctly in axios.js
      try {
        const response = await axios.post(url, {
          email: this.email,
          password: this.password,
        });

        const data = response.data;

        if (response.status === 200) {
          // Successful login
          localStorage.setItem("token", data.token);
          localStorage.setItem("user", data.name);
          this.$router.push("/");
        } else {
          console.error("Login failed", data);
        }
      } catch (error) {
        if (error.response) {
          console.error("An error occurred during login", error.response.data);
          this.error = error.response.data.error;
        } else if (error.request) {
          console.error("No response received from server", error.request);
        } else {
          console.error("An error occurred while setting up the request", error.message);
        }
      }
    },
  }
}
</script>
<style scoped>
@import url(https://fonts.googleapis.com/css?family=Roboto:300);

body {
  background: #efefef !important;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.form {
  font-family: "Roboto", sans-serif;
  position: relative;
  z-index: 1;
  background: #ffffff;
  max-width: 360px;
  margin: 80px auto;
  padding: 45px;
  text-align: center;
  box-shadow: rgb(99 99 99 / 20%) 0px 2px 8px 0px;
  border-radius: 10px;
}

.form input {
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}

.form button {
  text-transform: uppercase;
  outline: 0;
  background: #00749f;
  width: 100%;
  border: 0;
  padding: 15px;
  color: #ffffff;
  font-size: 14px;
  -webkit-transition: all 0.3 ease;
  transition: all 0.3 ease;
  cursor: pointer;
}

.form button:hover,
.form button:active,
.form button:focus {
  background: #3ba3d2;
}

.form .message {
  margin: 15px 0 0;
  color: #b3b3b3;
  font-size: 12px;
}

.error-message {
  font-size: 12px;
  color: #e64e65;
}
</style>