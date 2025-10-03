<template>
  <div class="login-container">
    <h2>Log In</h2>
    <form @submit.prevent="login">
      <input v-model="email" type="email" placeholder="Email address" required />
      <input v-model="password" type="password" placeholder="Password" required />
      <button type="submit">Log In</button>
    </form>
    <p class="signup-link">
      <span>Don't have an account?</span>
      <router-link to="/register">Sign Up</router-link>
    </p>
    <p v-if="error" class="error">{{ error }}</p>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const email = ref('')
const password = ref('')
const error = ref('')
const router = useRouter()

async function login() {
    error.value = ""
    try {
        await axios.get("/sanctum/csrf-cookie")
        await axios.post("/login", {
            email: email.value,
            password: password.value,
        })
        const res = await axios.get("/api/user")
        console.log("Logged in user:", res.data)
        router.push("/profile")
    } catch (e) {
        error.value = e.response?.data?.message || "Login failed"
    }
}
</script>

<!-- 🌈 GLOBAL BACKGROUND STYLE -->
<style>
body {
  margin: 0;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fbc2eb);
  background-attachment: fixed;
  font-family: Arial, sans-serif;
}
</style>

<!-- COMPONENT STYLES -->
<style scoped>
.login-container {
  width: 100%;
  max-width: 350px;
  padding: 30px;
  border: 1px solid #f8bbd0;
  border-radius: 10px;
  background: #fff0f6;
  box-shadow: 0 4px 12px rgba(233, 30, 99, 0.15);
}
.login-container h2 {
  text-align: center;
  color: #e91e63;
  margin-bottom: 20px;
  font-size: 1.6em;
  font-weight: bold;
}
.login-container input {
  width: 100%;
  padding: 10px;
  margin-bottom: 12px;
  border: 1px solid #f8bbd0;
  border-radius: 6px;
  background: #fff;
}
.login-container button {
  width: 100%;
  padding: 10px;
  background: #e91e63;
  color: #fff;
  border: none;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.2s;
}
.login-container button:hover {
  background: #ad1457;
}
.signup-link {
  text-align: center;
  margin-top: 16px;
}
.signup-link a {
  color: #e91e63;
  font-weight: bold;
  text-decoration: none;
  margin-left: 5px;
}
.error {
  color: #d00;
  text-align: center;
  margin-top: 10px;
  font-weight: bold;
}
</style>
