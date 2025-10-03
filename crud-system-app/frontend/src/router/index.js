import Vue from 'vue';
import Router from 'vue-router';
import Home from '../views/Home.vue';
import Dashboard from '../views/Dashboard.vue';
import Login from '../components/Auth/Login.vue';
import Register from '../components/Auth/Register.vue';
import ResourceList from '../components/Resource/ResourceList.vue';
import ResourceForm from '../components/Resource/ResourceForm.vue';
import ImportResource from '../components/Resource/ImportResource.vue';

Vue.use(Router);

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/register',
    name: 'Register',
    component: Register
  },
  {
    path: '/resources',
    name: 'ResourceList',
    component: ResourceList
  },
  {
    path: '/resources/new',
    name: 'ResourceForm',
    component: ResourceForm
  },
  {
    path: '/resources/import',
    name: 'ImportResource',
    component: ImportResource
  }
];

const router = new Router({
  mode: 'history',
  routes
});

export default router;