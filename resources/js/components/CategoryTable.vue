<template>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Category Name</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
      <tr scope="row" v-for="category in categories" :key="category.id">
        <td>{{ category.name }}</td>
        <td>
          <button class="btn btn-warning" @click="editCategory(category.id)">
            Edit
          </button>
        </td>
        <td>
          <button class="btn btn-danger" @click="deleteCategory(category.id)">
            Delete
          </button>
        </td>
      </tr>
    </tbody>
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
  methods: {
    deleteCategory(id) {
      axios
        .post(
          "/api/project-categories/delete",
          {
            id: id,
          },
          {
            headers: {
              "Content-Type": "application/json",
            },
          }
        )
        .then((response) => {
          this.categories = this.categories.filter(
            (category) => category.id !== id
          );
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
