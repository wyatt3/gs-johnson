<template>
  <div>
    <spinner v-if="loading"></spinner>
    <category-group
      class="text-gold-main"
      v-else
      v-for="category in projectsByCategory"
      :key="category.name"
      :category="category.name"
      :initialProjects="category.projects"
    ></category-group>
  </div>
</template>
<script>
import CategoryGroup from "./CategoryGroup.vue";
import Spinner from "../Spinner.vue";
export default {
  components: { CategoryGroup, Spinner },
  data() {
    return {
      loading: false,
      projectsByCategory: [],
    };
  },
  methods: {},
  mounted() {
    this.loading = true;
    axios
      .get("/api/projects")
      .then((response) => {
        this.projectsByCategory = response.data.filter(
          (category) => category.projects.length > 0
        );
      })
      .catch((error) => {
        console.log(error);
      })
      .finally(() => (this.loading = false));
  },
};
</script>
