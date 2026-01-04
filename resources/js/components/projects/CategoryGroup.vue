<template>
  <div>
    <h3>{{ category }}</h3>
    <div class="bg-primary rounded p-3 pb-1 mb-3">
      <div class="d-flex text-gold-main justify-content-between border-bottom pb-1 border-gold-secondary">
        <span>Project Name</span>
        <span>
          <span class="px-3">Edit</span>
          <span class="px-3">Delete</span>
        </span>
      </div>
      <draggable v-model="projects" @change="updateOrder">
        <project-table-row
          class="my-2"
          v-for="project in projects"
          :key="project.id"
          :project="project"
        ></project-table-row>
      </draggable>
    </div>
  </div>
</template>
<script>
import draggable from "vue-draggable";
import ProjectTableRow from "./ProjectTableRow.vue";
export default {
  components: { ProjectTableRow, draggable },
  props: ["category", "initialProjects"],
  data() {
    return {
      projects: this.initialProjects,
    };
  },
  methods: {
    updateOrder() {
      this.projects.forEach((project, index) => {
        project.order = index + 1;
        axios
          .post(
            "/api/projects/update-order",
            {
              id: project.id,
              order: project.order,
            },
            {
              headers: {
                "Content-Type": "application/json",
              },
            }
          )
          .catch((error) => {
            console.log(error.response);
          });
      });
    },
  },
};
</script>
