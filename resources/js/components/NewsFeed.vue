<template>
    <div>
        <!-- Navbar -->
        <nav class="navbar">
            <router-link to="/newsfeed">News Feed</router-link>
            <router-link to="/tasks">Tasks</router-link>
            <router-link to="/profile">Profile</router-link>
            <router-link to="/import-users">Import Users</router-link>
            <button class="logout-btn" @click="logout">🚪 Logout</button>
        </nav>

        <div class="feed-container">

            <div class="new-post-card">
                <h2 class="section-title">News Feed</h2>
                <form @submit.prevent="addPost" class="post-form">
                    <textarea
                        v-model.trim="content"
                        placeholder="What's on your mind?"
                        required
                    ></textarea>
                    <button type="submit" :disabled="loading">
                        {{ loading ? "Posting..." : "Post" }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import axios from "axios";

const content = ref("");
const loading = ref(false);

async function addPost() {
    if (!content.value.trim()) return;
    loading.value = true;
    try {
        await axios.post("/api/posts", { content: content.value });
        content.value = "";
    } catch (e) {
        console.error("Failed to add post", e);
    } finally {
        loading.value = false;
    }
}

function logout() {
    axios.post("/logout").then(() => {
        window.location.href = "/login";
    });
}
</script>

<style>
body {
    margin: 0;
    min-height: 100vh;
    background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fbc2eb);
    background-attachment: fixed;
    font-family: Arial, sans-serif;
}
</style>

<style scoped>
.navbar {
    display: flex;
    justify-content: center;
    gap: 20px;
    background: rgba(233, 30, 99, 0.9);
    padding: 12px;
    border-radius: 0 0 10px 10px;
    margin-bottom: 20px;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 100;
}
.navbar a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
}
.navbar a:hover {
    text-decoration: underline;
}
.logout-btn {
    background: none;
    border: none;
    color: #fff;
    cursor: pointer;
    font-weight: bold;
}
.logout-btn:hover {
    text-decoration: underline;
}

.feed-container {
    max-width: 600px;
    margin: 90px auto 20px auto;
}
.section-title {
    margin-bottom: 10px;
    color: #e91e63;
    font-size: 1.5em;
    font-weight: bold;
}
.new-post-card {
    background: #fff0f6;
    border: 1px solid #f8bbd0;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 20px;
}
.post-form textarea {
    width: 95.6%;
    padding: 10px;
    margin-bottom: 8px;
    border: 1px solid #f8bbd0;
    border-radius: 6px;
    resize: none;
}
.post-form button {
    background: #e91e63;
    color: #fff;
    padding: 8px 14px;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.2s;
}
.post-form button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}
.post-form button:hover:not(:disabled) {
    background: #ad1457;
}
</style>
