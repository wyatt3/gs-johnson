<template>
  <div>
    <desktop-nav :tabs="tabs" :activeTab="activeTab" @tabChange="changeActiveTab"></desktop-nav>
    <mobile-nav :tabs="tabs" :activeTab="activeTab" @tabChange="changeActiveTab"></mobile-nav>
    <div class="projects-container">
      <category-projects
        v-for="category in projects"
        :key="category.id"
        :name="category.id"
        :class="{ active: activeTab === category.id }"
        :categoryName="category.name"
        :initialProjects="category.projects"
      ></category-projects>
    </div>
  </div>
</template>

<script>
import Spinner from "../Spinner.vue";
import CategoryProjects from "./CategoryProjects.vue";
import DesktopNav from "./DesktopNav.vue";
import MobileNav from "./MobileNav.vue";
export default {
  components: { Spinner, CategoryProjects, DesktopNav, MobileNav },
  props: {
    categories: {
      type: Array,
      required: true,
    },
    category: {
      type: String,
      required: true,
    },
    projects: {
      type: Array,
      required: true,
    },
  },
};
</script>
