import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/Login.vue';
import Register from '../components/Register.vue';
import TaskList from '../components/TaskList.vue';
import ImportUsers from '../components/ImportUsers.vue';
import NewsFeed from '../components/NewsFeed.vue';
import Profile from '../components/UserProfile.vue';
const routes = [
  { path: '/', redirect: '/newsfeed' },
  { path: '/login', component: Login },
  { path: '/register', component: Register },
  { path: '/tasks', component: TaskList },
  { path: '/import-users', component: ImportUsers },
  { path: '/newsfeed', component: NewsFeed },
  { path: '/profile', component: Profile },
];

export default createRouter({
  history: createWebHistory(),
  routes,
});
