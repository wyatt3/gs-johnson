<template>
  <draggable class="row mt-3" v-model="media" @change="updateOrder">
    <img
      class="col-12 col-md-8 col-lg-6 mb-2"
      :src="'/media/' + img.path"
      v-for="img in media"
      :key="img.id"
    />
  </draggable>
</template>

<script>
import draggable from "vuedraggable";
import axios from "axios";
export default {
  components: { draggable },
  props: ["initialMedia"],
  data() {
    return {
      media: this.initialMedia,
    };
  },
  methods: {
    updateOrder() {
      this.media.forEach((media, index) => {
        axios
          .post("/api/project-media/update-order", {
            id: media.id,
            order: index + 1,
          })
          .then((response) => {
            console.log(response.data);
          })
          .catch((error) => {
            console.log(error.response);
          });
      });
    },
  },
};
</script>
