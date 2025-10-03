import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    user: null,
    resources: [],
    loading: false,
    error: null,
  },
  mutations: {
    SET_USER(state, user) {
      state.user = user;
    },
    SET_RESOURCES(state, resources) {
      state.resources = resources;
    },
    SET_LOADING(state, loading) {
      state.loading = loading;
    },
    SET_ERROR(state, error) {
      state.error = error;
    },
  },
  actions: {
    async login({ commit }, credentials) {
      commit('SET_LOADING', true);
      try {
        const response = await axios.post('/api/login', credentials);
        commit('SET_USER', response.data.user);
        commit('SET_ERROR', null);
      } catch (error) {
        commit('SET_ERROR', error.response.data.message);
      } finally {
        commit('SET_LOADING', false);
      }
    },
    async register({ commit }, userData) {
      commit('SET_LOADING', true);
      try {
        const response = await axios.post('/api/register', userData);
        commit('SET_USER', response.data.user);
        commit('SET_ERROR', null);
      } catch (error) {
        commit('SET_ERROR', error.response.data.message);
      } finally {
        commit('SET_LOADING', false);
      }
    },
    async fetchResources({ commit }) {
      commit('SET_LOADING', true);
      try {
        const response = await axios.get('/api/resources');
        commit('SET_RESOURCES', response.data);
        commit('SET_ERROR', null);
      } catch (error) {
        commit('SET_ERROR', error.response.data.message);
      } finally {
        commit('SET_LOADING', false);
      }
    },
    async importResources({ commit }, formData) {
      commit('SET_LOADING', true);
      try {
        const response = await axios.post('/api/resources/import', formData);
        commit('SET_RESOURCES', response.data);
        commit('SET_ERROR', null);
      } catch (error) {
        commit('SET_ERROR', error.response.data.message);
      } finally {
        commit('SET_LOADING', false);
      }
    },
  },
  getters: {
    isAuthenticated(state) {
      return !!state.user;
    },
    getResources(state) {
      return state.resources;
    },
    getLoading(state) {
      return state.loading;
    },
    getError(state) {
      return state.error;
    },
  },
});