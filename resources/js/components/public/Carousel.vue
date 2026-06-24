<template>
  <div class="custom-carousel">
    <button class="left-arrow" @click="prevSlide"><i class="bi bi-chevron-left"></i></button>
    <button class="right-arrow" @click="nextSlide"><i class="bi bi-chevron-right"></i></button>
    <div class="custom-carousel-slides">
      <div
        class="custom-carousel-item bg-dark"
        :class="{ active: currentSlide === index }"
        v-for="(category, index) in categories"
        :key="category.id"
      >
        <div class="left-side d-flex justify-content-center align-items-center">
          <div>
            <h2>{{ category.name }}</h2>
            <p>{{ category.description }}</p>
          </div>
        </div>
        <div class="right-side">
          <img :src="'/categories/' + category.image" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    categories: Array,
  },
  data() {
    return {
      currentSlide: 0,
      interval: 3000,
      timeToChange: 0,
    };
  },
  methods: {
    nextSlide() {
      this.timeToChange = this.interval;
      this.currentSlide = (this.currentSlide + 1) % this.categories.length;
    },
    prevSlide() {
      this.timeToChange = this.interval;
      this.currentSlide = (this.currentSlide - 1 + this.categories.length) % this.categories.length;
    },
  },

  mounted() {
    this.timeToChange = this.interval;
    setInterval(() => {
      if (this.timeToChange <= 0) {
        this.nextSlide();
      } else {
        this.timeToChange -= 100;
      }
    }, 100);
  },
};
</script>

<style scoped>
.custom-carousel {
  position: relative;
  height: 520px;
}

.custom-carousel-item {
  position: absolute;
  height: 520px;
  width: 100%;
  /* opacity: 0; */
  /* transition: opacity 0.3s ease-in-out; */
  display: none;
}

.custom-carousel-item.active {
  /* opacity: 1; */
  display: flex;
}

.left-arrow,
.right-arrow {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 1;
  cursor: pointer;
  background-color: transparent;
  border: none;
  font-size: 2rem;
  color: #fff;
  opacity: 0.5;
  transition: opacity 0.3s ease-in-out;
}

.left-arrow {
  left: 20px;
}

.right-arrow {
  right: 20px;
}

.left-side {
  width: 40%;
}

.right-side {
  width: 60%;
}

.right-side img {
  max-width: 100%;
  width: 100%;
  max-height: 100%;
}

h2 {
  font-size: 93px;
  font-family: "Abril Fatface", cursive;
  margin-bottom: 1.25rem;
}
</style>
