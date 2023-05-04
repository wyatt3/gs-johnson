<template>
  <draggable class="row" v-model="media" @change="updateOrder">
    <img :src="'/media/' + img.path" v-for="img in media" :key="img.id" />
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
          .patch(`/api/media/${media.id}`, {
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
