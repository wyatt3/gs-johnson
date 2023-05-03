<template>
  <div class="d-flex text-gold-secondary justify-content-between pb-1">
    <div role="button" class="d-flex align-items-center">
      <i class="bi bi-grip-horizontal me-3"></i>
      <span>{{ project.title }}</span>
    </div>
    <div class="d-flex">
      <div class="mx-1">
        <a class="btn btn-warning" :href="'/admin/projects/edit/' + project.id">
          Edit
        </a>
      </div>
      <div class="mx-1">
        <button class="btn btn-danger" @click="deleteProject(project.id)">
          Delete
        </button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["project"],
  methods: {
    deleteProject(id) {
      if (confirm("Are you sure you want to delete this project?")) {
        axios
          .post(
            "/api/projects/delete",
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
