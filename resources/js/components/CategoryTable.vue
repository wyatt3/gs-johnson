<template>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Category Name</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tr v-for="category in categories" :key="category.id">
      <td>{{ category.name }}</td>
      <td>
        <button class="btn btn-warning" @clidk="editCategory(category.id)">
          Edit
        </button>
      </td>
      <td>
        <button class="btn btn-danger" @click="deleteCategory(category.id)">
          Delete
        </button>
      </td>
    </tr>
  </table>
</template>
<script>
export default {
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
