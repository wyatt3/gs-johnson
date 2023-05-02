<template>
  <table class="table bg-primary rounded">
    <thead class="text-gold-main">
      <tr>
        <th scope="col">Category Name</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody class="text-gold-secondary">
      <category-table-row
        v-for="category in categories"
        :key="category.id"
        :category="category"
        :id="category.order"
      ></category-table-row>
    </tbody>
  </table>
</template>
<script>
import CategoryTableRow from "./CategoryTableRow.vue";
export default {
  components: { CategoryTableRow },
  data() {
    return {
      loading: false,
      categories: [],
    };
  },
  mounted() {
    this.loading = true;
    axios
      .get("/api/project-categories")
      .then((response) => {
        this.categories = response.data;
      })
      .catch((error) => {
        console.log(error);
      })
      .finally(() => (this.loading = false));
  },
};
</script>
