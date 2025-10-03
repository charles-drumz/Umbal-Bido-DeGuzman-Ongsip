<template>
    <div>
        <nav class="navbar">
            <router-link to="/newsfeed">News Feed</router-link>
            <router-link to="/tasks">Tasks</router-link>
            <router-link to="/profile">Profile</router-link>
            <router-link to="/import-users">Import Users</router-link>
            <button class="logout-btn" @click="logout">🚪 Logout</button>
        </nav>
        <main class="main-content">
            <router-view />
        </main>
    </div>
</template>

<script setup>
import axios from "axios";
import { useRouter } from "vue-router";

const router = useRouter();

async function logout() {
    await axios.post("/api/logout");
    router.push("/login");
}
</script>

<style scoped>
.navbar {
    display: flex;
    gap: 20px;
    padding: 12px;
    background: #e91e63;
}
.navbar a {
    color: #fff;
    font-weight: bold;
    text-decoration: none;
}
.navbar a.router-link-active {
    text-decoration: underline;
}
.main-content {
    padding: 20px;
}
</style>
