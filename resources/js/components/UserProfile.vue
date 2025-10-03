<template>
    <div class="profile-page">
        <!-- Navbar -->
        <nav class="navbar">
            <router-link to="/newsfeed">News Feed</router-link>
            <router-link to="/tasks">Tasks</router-link>
            <router-link to="/profile">Profile</router-link>
            <router-link to="/import-users">Import Users</router-link>
            <button class="logout-btn" @click="logout">🚪 Logout</button>
        </nav>

        <!-- Header -->
        <div class="profile-header">
            <div class="avatar-section">
                <img
                    :src="avatarUrl"
                    alt="Avatar"
                    class="avatar"
                    @click="triggerFileInput"
                />
                <!-- ✅ hidden file input -->
                <input
                    ref="avatarInput"
                    type="file"
                    @change="onAvatarChange"
                    accept="image/*"
                    style="display: none"
                />
                <div class="avatar-overlay">Change</div>
            </div>

            <div class="profile-info">
                <h2>{{ first_name }} {{ last_name }}</h2>
                <p class="bio">{{ bio || "No bio yet..." }}</p>
                <p class="email">{{ email }}</p>
                <p class="address">{{ address || "No address yet..." }}</p>
                <button @click="editing = !editing" class="edit-btn">
                    {{ editing ? "Cancel" : "Edit Profile" }}
                </button>
            </div>
        </div>

        <!-- Stats -->
        <div class="profile-stats">
            <div><strong>12</strong><span>Posts</span></div>
            <div><strong>200</strong><span>Followers</span></div>
            <div><strong>180</strong><span>Following</span></div>
        </div>

        <!-- Edit Form -->
        <form v-if="editing" @submit.prevent="updateProfile" class="edit-form">
            <input v-model="first_name" type="text" placeholder="First Name" required />
            <input v-model="last_name" type="text" placeholder="Last Name" required />
            <input v-model="bio" type="text" placeholder="Bio" />

            <!-- ✅ Address field -->
            <div class="form-group">
                <input v-model="address" type="text" placeholder="Address" />
            </div>

            <button type="submit">Save</button>
        </form>

        <p v-if="message" class="success">{{ message }}</p>
        <p v-if="error" class="error">{{ error }}</p>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const first_name = ref("");
const last_name = ref("");
const email = ref("");
const bio = ref("");
const address = ref("");
const avatarUrl = ref("/images/default-avatar.png");
const avatarInput = ref(null);
const message = ref("");
const error = ref("");
const editing = ref(false);

onMounted(async () => {
    try {
        const res = await axios.get("/api/profile");
        first_name.value = res.data.first_name || "";
        last_name.value = res.data.last_name || "";
        email.value = res.data.email || "";
        bio.value = res.data.bio || "";
        address.value = res.data.address || "";
        avatarUrl.value = res.data.avatar_url || "/images/default-avatar.png";
    } catch (e) {
        error.value = "Failed to load profile";
    }
});

function triggerFileInput() {
    avatarInput.value.click();
}

function onAvatarChange(e) {
    const file = e.target.files[0];
    if (!file) return;
    avatarUrl.value = URL.createObjectURL(file);
}

async function updateProfile() {
    message.value = "";
    error.value = "";

    try {
        const formData = new FormData();
        formData.append("first_name", first_name.value);
        formData.append("last_name", last_name.value);
        formData.append("bio", bio.value);
        formData.append("address", address.value);

        if (avatarInput.value && avatarInput.value.files.length > 0) {
            formData.append("avatar", avatarInput.value.files[0]);
        }

        const res = await axios.post("/api/profile", formData, {
            headers: { "Content-Type": "multipart/form-data" },
        });

        message.value = res.data.message || "Profile updated!";
        if (res.data.user && res.data.user.avatar_url) {
            avatarUrl.value = res.data.user.avatar_url;
        }
        editing.value = false;
    } catch (e) {
        error.value = "Update failed";
    }
}

function logout() {
    axios.post("/logout").then(() => {
        window.location.href = "/login";
    });
}
</script>

<style scoped>
.navbar {
    display: flex;
    justify-content: center;
    gap: 20px;
    background: #e91e63;
    padding: 12px 24px;
    border-radius: 0 0 8px 8px;
    margin-bottom: 24px;
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 10;
}
.navbar a {
    color: white;
    font-weight: bold;
    text-decoration: none;
}
.navbar a.router-link-exact-active {
    text-decoration: underline;
}

.profile-page {
    max-width: 800px;
    margin: 100px auto 30px;
    padding: 20px;
    font-family: Arial, sans-serif;
}
.profile-header {
    display: flex;
    align-items: center;
    gap: 40px;
}
.avatar-section {
    position: relative;
    display: inline-block;
    cursor: pointer;
}
.avatar {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    border: 4px solid #e91e63;
    object-fit: cover;
    transition: 0.3s ease;
}
.avatar:hover {
    opacity: 0.7;
}
.avatar-overlay {
    position: absolute;
    bottom: 5px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 0, 0, 0.6);
    color: #fff;
    font-size: 12px;
    padding: 3px 8px;
    border-radius: 12px;
    opacity: 0;
    transition: opacity 0.3s;
}
.avatar-section:hover .avatar-overlay {
    opacity: 1;
}
.profile-info {
    flex: 1;
}
.profile-info h2 {
    font-size: 1.6em;
    margin-bottom: 5px;
}
.profile-info .bio {
    font-style: italic;
    color: #555;
    margin-bottom: 5px;
}
.profile-info .email {
    color: #777;
    margin-bottom: 10px;
}
.edit-btn {
    padding: 6px 12px;
    background: #e91e63;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
}
.edit-btn:hover {
    background: #ad1457;
}
.profile-stats {
    display: flex;
    justify-content: space-around;
    margin: 20px 0;
    text-align: center;
}
.profile-stats div {
    display: flex;
    flex-direction: column;
}
.profile-stats strong {
    font-size: 1.2em;
}

.edit-form {
    margin: 20px 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.edit-form input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
}
.edit-form button {
    padding: 10px;
    background: #e91e63;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
}
.edit-form button:hover {
    background: #ad1457;
}
.success {
    color: #28a745;
    text-align: center;
    margin-top: 10px;
}
.error {
    color: #d00;
    text-align: center;
    margin-top: 10px;
}
</style>
