<template>
  <div class="resource-form">
    <h2>{{ isEdit ? 'Edit Resource' : 'Create Resource' }}</h2>
    <form @submit.prevent="submitForm">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" v-model="resource.name" id="name" required />
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea v-model="resource.description" id="description" required></textarea>
      </div>
      <button type="submit">{{ isEdit ? 'Update' : 'Create' }}</button>
      <button type="button" @click="cancel">Cancel</button>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    resourceData: {
      type: Object,
      default: () => ({ name: '', description: '' }),
    },
    isEdit: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      resource: { ...this.resourceData },
    };
  },
  methods: {
    submitForm() {
      if (this.isEdit) {
        this.$emit('update-resource', this.resource);
      } else {
        this.$emit('create-resource', this.resource);
      }
    },
    cancel() {
      this.$emit('cancel');
    },
  },
};
</script>

<style scoped>
.resource-form {
  max-width: 400px;
  margin: auto;
}
.form-group {
  margin-bottom: 15px;
}
</style>