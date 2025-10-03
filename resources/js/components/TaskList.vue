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
        <!-- Task List -->
        <div class="tasklist-container">
            <h2>My Tasks</h2>
            <form @submit.prevent="addTask" class="task-form">
                <input
                    v-model="title"
                    type="text"
                    placeholder="Task Title"
                    required
                />
                <textarea
                    v-model="description"
                    placeholder="Description"
                ></textarea>
                <button type="submit">Add Task</button>
            </form>

            <ul class="task-list">
                <li v-for="task in tasks" :key="task.id" class="task-item">
                    <div>
                        <strong>{{ task.title }}</strong>
                        <p>{{ task.description }}</p>
                    </div>
                    <button @click="deleteTask(task.id)">Delete</button>
                </li>
            </ul>

            <p v-if="error" class="error">{{ error }}</p>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const tasks = ref([]);
const title = ref("");
const description = ref("");
const error = ref("");

// ✅ Fetch tasks
async function fetchTasks() {
    try {
        const res = await axios.get("/api/tasks");
        tasks.value = res.data;
    } catch (e) {
        error.value = "Failed to load tasks";
    }
}

// ✅ Add task
async function addTask() {
    try {
        const res = await axios.post("/api/tasks", {
            title: title.value,
            description: description.value,
        });
        tasks.value.push(res.data);
        title.value = "";
        description.value = "";
    } catch (e) {
        error.value = "Failed to add task";
    }
}

// ✅ Delete task
async function deleteTask(id) {
    try {
        await axios.delete(`/api/tasks/${id}`);
        tasks.value = tasks.value.filter((task) => task.id !== id);
    } catch (e) {
        error.value = "Failed to delete task";
    }
}

// ✅ Logout
function logout() {
    axios.post("/logout").then(() => {
        window.location.href = "/login";
    });
}

onMounted(fetchTasks);
</script>

<style scoped>
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    display: flex;
    justify-content: center;
    gap: 20px;
    background: #e91e63;
    padding: 14px 28px;
    border-radius: 0 0 10px 10px;
    z-index: 1000;
}
.nav-link {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
}
.nav-link:hover {
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
.tasklist-container {
    width: 90%;
    max-width: 650px;
    margin: 40px auto;
    padding: 30px;
    border-radius: 12px;
    background: #fff0f6;
    border: 1px solid #f8bbd0;
    box-shadow: 0 2px 8px rgba(233, 30, 99, 0.08);
}
.tasklist-container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #e91e63;
    font-size: 1.5em;
    font-weight: bold;
}
.task-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 25px;
}
.task-form input {
    padding: 10px;
    border: 1px solid #f8bbd0;
    border-radius: 6px;
    background: #fff;
    font-size: 1em;
    margin-bottom: 8px;
}
.task-form textarea {
    min-height: 60px;
    resize: vertical;
    padding: 10px;
    border: 1px solid #f8bbd0;
    border-radius: 6px;
    background: #fff;
    font-size: 1em;
    margin-bottom: 8px;
}
.task-form button {
    padding: 10px;
    background: #e91e63;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.2s;
}
.task-form button:hover {
    background: #ad1457;
}
.task-list {
    list-style: none;
    padding: 0;
}
.task-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 15px;
    border-bottom: 1px solid #f8bbd0;
    background: #fff;
    border-radius: 8px;
    margin-bottom: 10px;
    box-shadow: 0 1px 4px rgba(233, 30, 99, 0.04);
}
.task-item button {
    background: #e91e63;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 6px 14px;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.2s;
}
.task-item button:hover {
    background: #ad1457;
}
.error {
    color: #d00;
    text-align: center;
    margin-top: 10px;
}
</style>
