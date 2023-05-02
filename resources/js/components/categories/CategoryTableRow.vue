<template>
  <tr scope="row">
    <td>
      <span v-show="!edit">{{ category.name }}</span>
      <input v-show="edit" type="text" v-model="category.name" />
    </td>
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
    editCategory(id) {},
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
