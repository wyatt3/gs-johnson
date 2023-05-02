<template>
  <div class="d-flex justify-content-between">
    <div class="d-flex align-items-center">
      <i role="button" class="bi bi-grip-horizontal me-3"></i>
      <span role="button" v-show="!edit">{{ category.name }}</span>
      <input
        class="form-control"
        v-show="edit"
        type="text"
        v-model="category.name"
      />
    </div>
    <div class="d-flex">
      <div class="mx-1">
        <button
          class="btn btn-warning"
          @click="editCategory()"
          v-text="edit ? 'Save' : 'Edit'"
        ></button>
      </div>
      <div class="mx-1">
        <button class="btn btn-danger" @click="deleteCategory(category.id)">
          Delete
        </button>
      </div>
    </div>
  </div>
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
