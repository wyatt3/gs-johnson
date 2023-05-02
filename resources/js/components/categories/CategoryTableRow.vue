<template>
  <tr scope="row">
    <td>
      <span v-show="!edit">{{ category.name }}</span>
      <input v-show="edit" type="text" v-model="category.name" />
    </td>
    <td>
      <button class="btn btn-warning" @click="editCategory()">Edit</button>
    </td>
    <td>
      <button class="btn btn-danger" @click="deleteCategory(category.id)">
        Delete
      </button>
    </td>
  </tr>
</template>
<script>
export default {
  props: ["category"],
  data() {
    return {
      edit: false,
    };
  },
  methods: {
    editCategory() {
      this.edit = !this.edit;
      if (!this.edit) {
        this.updateCategory();
      }
    },
    updateCategory() {
      axios
        .post(
          "/api/project-categories/update",
          {
            id: this.category.id,
            name: this.category.name,
            order: this.category.order,
          },
          {
            headers: {
              "Content-Type": "application/json",
            },
          }
        )
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteCategory(id) {
      if (confirm("Are you sure you want to delete this category?")) {
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
            this.$destroy();
            this.$el.remove();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>
