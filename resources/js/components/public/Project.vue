<template>
  <div class="container mb-4">
    <h3 class="project-title">{{ project.title }}</h3>
    <div class="project-details">
      <div class="project-images-container row">
        <img
          class="project-image col-12 col-md-6 col-lg-4 mb-3"
          :src="'/media/' + img.path"
          v-for="img in project.media"
          :key="img.id"
        />
      </div>
      <p class="text-gold-secondary">{{ project.description }}</p>
    </div>
  </div>
</template>

<script>
export default {
  props: ["project"],
};
</script>
