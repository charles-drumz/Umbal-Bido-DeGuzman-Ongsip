<template>
  <div>
    <h1>Resource List</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="resource in resources" :key="resource.id">
          <td>{{ resource.id }}</td>
          <td>{{ resource.name }}</td>
          <td>{{ resource.description }}</td>
          <td>
            <button @click="editResource(resource.id)">Edit</button>
            <button @click="deleteResource(resource.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
    <button @click="fetchResources">Refresh</button>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      resources: [],
    };
  },
  methods: {
    fetchResources() {
      axios.get('/api/resources')
        .then(response => {
          this.resources = response.data;
        })
        .catch(error => {
          console.error('Error fetching resources:', error);
        });
    },
    editResource(id) {
      this.$router.push({ name: 'resource-edit', params: { id } });
    },
    deleteResource(id) {
      if (confirm('Are you sure you want to delete this resource?')) {
        axios.delete(`/api/resources/${id}`)
          .then(() => {
            this.fetchResources();
          })
          .catch(error => {
            console.error('Error deleting resource:', error);
          });
      }
    },
  },
  mounted() {
    this.fetchResources();
  },
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
}
th, td {
  border: 1px solid #ddd;
  padding: 8px;
}
th {
  background-color: #f2f2f2;
}
</style>