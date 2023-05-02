<template>
  <spinner v-if="loading"></spinner>
  <div v-else class="d-flex justify-content-between">
    <div class="d-flex align-items-center">
      <i role="button" class="bi bi-grip-horizontal me-3"></i>
      <span role="button" v-show="!edit">{{ category.name }}</span>
      <input class="form-control" v-if="edit" type="text" v-model="name" />
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
        <button
          class="btn btn-danger"
          @click="deleteCategory(category.id)"
          v-text="edit ? 'Cancel' : 'Delete'"
        ></button>
      </div>
    </div>
  </div>
</template>
<script>
import Spinner from "../Spinner.vue";
export default {
  components: { Spinner },
  props: ["category"],
  data() {
    return {
      loading: false,
      edit: false,
      name: this.category.name,
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
      this.loading = true;
      axios
        .post(
          "/api/project-categories/update",
          {
            id: this.category.id,
            name: this.name,
            order: this.category.order,
          },
          {
            headers: {
              "Content-Type": "application/json",
            },
          }
        )
        .then(() => {
          this.category.name = this.name;
          this.loading = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    deleteCategory(id) {
      if (this.edit) {
        this.edit = false;
        this.name = this.category.name;
      } else {
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
      }
    },
  },
};
</script>
