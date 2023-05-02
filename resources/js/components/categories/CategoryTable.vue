<template>
  <div class="col-12 col-md-8 col-lg-6 mx-auto">
    <h1 class="text-gold-main">Categories</h1>
    <div class="bg-primary rounded p-3 pb-1">
      <div
        class="d-flex text-gold-main justify-content-between border-bottom pb-1 border-gold-secondary"
      >
        <span>Category Name</span>
        <span>
          <span class="px-3">Edit</span>
          <span class="px-3">Delete</span>
        </span>
      </div>
      <div class="text-gold-secondary">
        <draggable v-model="categories" @change="updateOrder">
          <category-table-row
            class="my-2"
            v-for="category in categories"
            :key="category.id"
            :category="category"
          ></category-table-row>
        </draggable>
      </div>
    </div>
  </div>
</template>
<script>
import CategoryTableRow from "./CategoryTableRow.vue";
import draggable from "vuedraggable";
export default {
  components: { CategoryTableRow, draggable },
  data() {
    return {
      loading: false,
      categories: [],
    };
  },
  methods: {
    async updateOrder() {
      this.categories.forEach((category, index) => {
        category.order = index + 1;
        axios
          .post(
            "/api/project-categories/update",
            {
              id: category.id,
              name: category.name,
              order: category.order,
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
