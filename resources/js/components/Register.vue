<template>
    <div class="register-container">
        <h2>Sign Up</h2>
        <form @submit.prevent="register">
            <input
                v-model="first_name"
                type="text"
                placeholder="First Name"
                required
            />
            <input
                v-model="last_name"
                type="text"
                placeholder="Last Name"
                required
            />
            <input v-model="name" type="text" placeholder="Username" required />
            <input v-model="email" type="email" placeholder="Email" required />
            <input
                v-model="password"
                type="password"
                placeholder="Password"
                required
            />
            <input
                v-model="password_confirmation"
                type="password"
                placeholder="Confirm Password"
                required
            />
            <button type="submit">Sign Up</button>
        </form>
        <p class="login-link">
            <span>Already have an account?</span>
            <router-link to="/login">Log In</router-link>
        </p>
        <p v-if="error" class="error">{{ error }}</p>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

const first_name = ref("");
const last_name = ref("");
const name = ref("");
const email = ref("");
const password = ref("");
const password_confirmation = ref("");
const error = ref("");

async function register() {
    try {
        await axios.post("/register", {
            first_name: first_name.value,
            last_name: last_name.value,
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: password_confirmation.value,
        });
        window.location.href = "/login";
    } catch (e) {
        error.value = "Registration failed";
    }
}
</script>
<style scoped>
.register-container {
    max-width: 350px;
    margin: 60px auto;
    padding: 30px;
    border: 1px solid #f8bbd0;
    border-radius: 8px;
    background: #fff0f6;
    box-shadow: 0 2px 8px rgba(233, 30, 99, 0.07);
}
.register-container h2 {
    text-align: center;
    color: #e91e63;
    margin-bottom: 20px;
}
.register-container input {
    width: 100%;
    padding: 10px;
    margin-bottom: 12px;
    border: 1px solid #f8bbd0;
    border-radius: 4px;
    background: #fff;
}
.register-container button {
    width: 100%;
    padding: 10px;
    background: #e91e63;
    color: #fff;
    border: none;
    border-radius: 4px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.2s;
}
.register-container button:hover {
    background: #ad1457;
}
.login-link {
    text-align: center;
    margin-top: 16px;
}
.login-link a {
    color: #e91e63;
    font-weight: bold;
    text-decoration: none;
    margin-left: 5px;
}
.error {
    color: #d00;
    text-align: center;
    margin-top: 10px;
}
</style>
