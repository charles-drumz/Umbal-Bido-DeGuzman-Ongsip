<template>
  <div class="home">
    <h1>Welcome to the CRUD System</h1>
    <p>This application allows you to manage resources with full CRUD functionality.</p>
    <router-link to="/login">Login</router-link> | 
    <router-link to="/register">Register</router-link>
  </div>
</template>

<script>
export default {
  name: 'Home',
}
</script>

<style scoped>
.home {
  text-align: center;
  margin-top: 50px;
}
</style>