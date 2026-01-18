<template>
  <div>
    <h1>Categories</h1>
    <div class="d-flex mb-2">
      <button
        class="btn btn-primary me-2"
        type="button"
        @click="add"
        v-text="adding ? 'Save' : 'Add Category'"
      ></button>
      <div v-if="adding" class="d-flex">
        <button class="btn btn-warning me-2" @click="cancelAdd">Cancel</button>
        <input class="form-control" type="text" v-model="newCategoryName" placeholder="Category Name" />
      </div>
    </div>
    <div class="bg-primary rounded p-3 pb-1">
      <div class="d-flex text-gold-main justify-content-between border-bottom pb-1 border-white">
        <span>Category Name</span>
        <span>
          <span class="px-3">Edit</span>
          <span class="px-3">Delete</span>
        </span>
      </div>
      <spinner v-if="loading"></spinner>
      <div class="text-gold-secondary" v-else>
        <draggable v-model="categories" @change="updateOrder">
          <category-table-row
            class="my-2"
            v-for="category in categories"
            :key="category.id"
            :category="category"
            @deleted="removeFromArray"
          ></category-table-row>
        </draggable>
      </div>
    </div>
  </div>
</template>
<script>
import CategoryTableRow from "./CategoryTableRow.vue";
import draggable from "vue-draggable";
import Spinner from "../Spinner.vue";
export default {
  components: { CategoryTableRow, draggable, Spinner },
  data() {
    return {
      newCategoryName: "",
      adding: false,
      loading: false,
      categories: [],
    };
  },
  methods: {
    add() {
      if (this.adding) {
        this.addCategory();
      }
      this.adding = true;
    },
    cancelAdd() {
      this.adding = false;
    },
    addCategory() {
      this.loading = true;
      axios
        .post(
          "/api/project-categories/create",
          {
            name: this.newCategoryName,
            order: this.categories.length + 1,
          },
          {
            headers: {
              "Content-Type": "application/json",
            },
          }
        )
        .then((response) => {
          this.categories.push(response.data);
        })
        .catch((error) => {
          console.log(error.response);
        })
        .finally(() => {
          this.newCategoryName = "";
          this.loading = false;
          this.adding = false;
        });
    },
    updateOrder() {
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
    removeFromArray(category) {
      this.categories.splice(this.categories.indexOf(category), 1);
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
