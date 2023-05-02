<template>
  <div class="col-12 col-md-8 col-lg-6 mx-auto">
    <h1 class="text-gold-main">Projects</h1>
    <category-group
      class="text-gold-main"
      v-for="(projects, name) in projectsByCategory"
      :key="name"
      :category="name"
      :projects="projects"
    ></category-group>
  </div>
</template>
<script>
import CategoryGroup from "./CategoryGroup.vue";
export default {
  components: { CategoryGroup },
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
        this.projectsByCategory = response.data;
      })
      .catch((error) => {
        console.log(error);
      })
      .finally(() => (this.loading = false));
  },
};
</script>
