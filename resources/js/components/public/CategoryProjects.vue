<template>
  <div class="container project-category">
    <h2 class="mt-4 mb-3 project-category-title">{{ categoryName }}</h2>
    <project
      v-for="project in projects"
      :key="project.id"
      :project="project"
    ></project>
  </div>
</template>

<script>
import project from "./Project.vue";
export default {
  props: ["categoryName", "initialProjects"],
  components: { project },
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
