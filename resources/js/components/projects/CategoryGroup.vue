<template>
  <div>
    <h3>{{ category }}</h3>
    <div class="bg-primary rounded p-3 pb-1 mb-3">
      <div
        class="d-flex text-gold-main justify-content-between border-bottom pb-1 border-gold-secondary"
      >
        <span>Project Name</span>
        <span>
          <span class="px-3">Edit</span>
          <span class="px-3">Delete</span>
        </span>
      </div>
      <draggable v-model="projects" @change="updateOrder">
        <category-table-row
          class="my-2"
          v-for="project in projects"
          :key="project.id"
          :id="category.order"
        ></category-table-row>
      </draggable>
    </div>
  </div>
</template>
<script>
import draggable from "vuedraggable";
import ProjectTableRow from "./ProjectTableRow.vue";
export default {
  props: ["category", "projects"],
};
</script>
