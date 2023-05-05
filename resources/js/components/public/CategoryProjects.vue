<template>
  <div>
    <div v-for="project in projects" :key="project.id">
      {{ project.title }}
    </div>
  </div>
</template>

<script>
export default {
  props: ["initialProjects"],
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
