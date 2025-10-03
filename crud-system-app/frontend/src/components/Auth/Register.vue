<template>
  <div class="register">
    <h2>Register</h2>
    <form @submit.prevent="registerUser">
      <div>
        <label for="name">Name</label>
        <input type="text" v-model="form.name" required />
      </div>
      <div>
        <label for="email">Email</label>
        <input type="email" v-model="form.email" required />
      </div>
      <div>
        <label for="password">Password</label>
        <input type="password" v-model="form.password" required />
      </div>
      <div>
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" v-model="form.password_confirmation" required />
      </div>
      <button type="submit">Register</button>
    </form>
    <div v-if="error" class="error">{{ error }}</div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
      error: null
    };
  },
  methods: {
    async registerUser() {
      this.error = null;
      try {
        const response = await axios.post('/api/register', this.form);
        // Handle successful registration (e.g., redirect or show a success message)
      } catch (err) {
        this.error = err.response.data.message || 'Registration failed';
      }
    }
  }
};
</script>

<style scoped>
.register {
  max-width: 400px;
  margin: auto;
}
.error {
  color: red;
}
</style>