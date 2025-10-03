<template>
  <div>
    <h1>Import Resources</h1>
    <input type="file" @change="onFileChange" />
    <button @click="importResources">Import</button>
    <div v-if="message">{{ message }}</div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      file: null,
      message: ''
    };
  },
  methods: {
    onFileChange(event) {
      this.file = event.target.files[0];
    },
    async importResources() {
      if (!this.file) {
        this.message = 'Please select a file to import.';
        return;
      }

      const formData = new FormData();
      formData.append('file', this.file);

      try {
        const response = await this.axios.post('/api/resources/import', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        });
        this.message = response.data.message;
      } catch (error) {
        this.message = 'Error importing resources: ' + error.response.data.message;
      }
    }
  }
};
</script>

<style scoped>
/* Add any styles specific to the import resource component here */
</style>