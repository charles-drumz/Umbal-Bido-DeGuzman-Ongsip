<template>
  <div>
    <nav class="navbar">
      <router-link to="/newsfeed">News Feed</router-link>
      <router-link to="/tasks">Tasks</router-link>
      <router-link to="/profile">Profile</router-link>
      <router-link to="/import-users">Import Users</router-link>
      <button class="logout-btn" @click="logout">🚪 Logout</button>
    </nav>

    <div class="import-container">
      <h2>Import Users (CSV)</h2>
      <form @submit.prevent="importUsers">
        <input type="file" @change="handleFile" accept=".csv" required />
        <button type="submit">Import</button>
      </form>
      <p v-if="message">{{ message }}</p>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const file = ref(null);
const message = ref("");
const router = useRouter();

function handleFile(e) {
  file.value = e.target.files[0];
}

async function importUsers() {
  if (!file.value) return;
  const formData = new FormData();
  formData.append("file", file.value);

  try {
    const res = await axios.post("/api/users/import", formData, {
      headers: { "Content-Type": "multipart/form-data" },
    });
    message.value = res.data.message;
  } catch (err) {
    message.value = "Import failed.";
  }
}

function logout() {
  axios.post("/logout").then(() => {
    router.push("/login");
  });
}
</script>

<style scoped>
.navbar {
  display: flex;
  justify-content: center;
  gap: 20px;
  background: #e91e63;
  padding: 14px 20px;
  border-radius: 0 0 10px 10px;
  margin: 0;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  width: 100%;
  z-index: 1000;
  box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}

.navbar a {
  color: white;
  font-weight: bold;
  text-decoration: none;
}

.navbar a.router-link-exact-active {
  text-decoration: underline;
}

.logout-btn {
  background: transparent;
  border: none;
  color: white;
  font-weight: bold;
  cursor: pointer;
}

.import-container {
  max-width: 400px;
  margin: 100px auto 40px;
  padding: 30px;
  border-radius: 12px;
  background: #fff0f6;
  border: 1px solid #f8bbd0;
  box-shadow: 0 2px 8px rgba(233, 30, 99, 0.08);
  text-align: center;
}

.import-container h2 {
  color: #e91e63;
  margin-bottom: 20px;
  font-size: 1.4em;
  font-weight: bold;
}

.import-container form {
  display: flex;
  flex-direction: column;
  gap: 15px;
  align-items: center;
}

.import-container input[type="file"] {
  padding: 8px;
  border: 1px solid #f8bbd0;
  border-radius: 6px;
  background: #fff;
  width: 100%;
}

.import-container button {
  background: #e91e63;
  color: #fff;
  padding: 10px 18px;
  border: none;
  border-radius: 6px;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.2s;
}

.import-container button:hover {
  background: #ad1457;
}

.import-container p {
  margin-top: 15px;
  color: #28a745;
  font-weight: bold;
}
</style>
