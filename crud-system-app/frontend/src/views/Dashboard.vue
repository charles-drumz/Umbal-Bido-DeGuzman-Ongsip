<template>
  <div class="dashboard">
    <h1>Dashboard</h1>
    <p>Welcome, {{ user.name }}!</p>
    <div class="user-info">
      <h2>Your Information</h2>
      <ul>
        <li>Email: {{ user.email }}</li>
        <li>Joined: {{ user.created_at }}</li>
      </ul>
    </div>
    <div class="resource-actions">
      <router-link to="/resources" class="btn">Manage Resources</router-link>
      <router-link to="/import" class="btn">Import Resources</router-link>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {}
    };
  },
  created() {
    this.fetchUser();
  },
  methods: {
    fetchUser() {
      // Fetch user data from the API
      axios.get('/api/user')
        .then(response => {
          this.user = response.data;
        })
        .catch(error => {
          console.error("There was an error fetching the user data:", error);
        });
    }
  }
};
</script>

<style scoped>
.dashboard {
  padding: 20px;
}

.user-info {
  margin-top: 20px;
}

.resource-actions {
  margin-top: 30px;
}

.btn {
  display: inline-block;
  margin-right: 10px;
  padding: 10px 15px;
  background-color: #007bff;
  color: white;
  text-decoration: none;
  border-radius: 5px;
}
</style>