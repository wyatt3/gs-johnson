<template>
  <div class="container project-category">
    <h2>{{ categoryName }}</h2>
    <div v-for="project in projects" :key="project.id">
      {{ project.title }}
    </div>
  </div>
</template>

<script>
export default {
  props: ["categoryName", "initialProjects"],
  data() {
    return {
      projects: [],
    };
  },
  created() {
    this.projects = this.initialProjects;
  },
};
</script>
