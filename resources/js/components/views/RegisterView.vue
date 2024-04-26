<template>
  <div class="register">
    <div class="form">
      <div class="box-title">
        <h1>Register</h1>
      </div>
      <form class="register-form" @submit.prevent="register">
        <input type="name" name="name" placeholder="name" v-model="name" />
        <input type="email" name="email" placeholder="email" v-model="email" />
        <input type="password" name="password" placeholder="password" v-model="password" />
        <button type="submit">Regiter</button>
        <p class="mt-2 text-center">Already have an account? <router-link to="/login">Login</router-link></p>
        <p v-if="error" class="error-message mt-3">⛔ {{ error }} </p>
      </form>
    </div>
  </div>
</template>
<script>
export default {
  name: "RegisterView",
  data() {
    return {
      name: "",
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
    async register() {
      if (!this.name || !this.email || !this.password) { // Check if fields are empty
        this.error = "Fill all the fields";
        return; // Stop execution if fields are empty
      }

      try {
        const url = `/api/register`;

        const response = await axios.post(url, {
          name: this.name,
          email: this.email,
          password: this.password,
        });

        if (response.status === 200) { // Check if request was successful
          this.$router.push("/login");
        } else {
          this.error = "Enter valid values";
          console.error("Registration failed", response.data);
        }
      } catch (error) {
        console.error("An error occurred during registration", error);
      }
    },
  },
};

</script>
<style scoped>
@import url(https://fonts.googleapis.com/css?family=Roboto:300);

body {
  background: #efefef;
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