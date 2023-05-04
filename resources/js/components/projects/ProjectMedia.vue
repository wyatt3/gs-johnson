<template>
  <draggable class="row mt-3" v-model="media" @change="updateOrder">
    <div
      class="col-12 col-md-8 col-lg-6 mb-2 img"
      v-for="img in media"
      :key="img.id"
    >
      <span class="delete" @click="deleteMedia(img.id)">&times;</span>
      <img class="w-100" :src="'/media/' + img.path" />
    </div>
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
    deleteMedia(id) {
      axios
        .post("/api/project-media/delete", {
          id,
        })
        .then((response) => {
          console.log(response.data);
          this.media.splice(this.media.indexOf(this.media), 1);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
};
</script>

<style scoped>
.img {
  position: relative;
}
.delete {
  height: 30px;
  line-height: 30px;
  width: 30px;
  font-size: 1em;
  border-radius: 50%;
  background-color: #992525;
  color: white;
  text-align: center;
  cursor: pointer;
  position: absolute;
  top: -12px;
  right: 3px;
}
</style>
