<template>
  <div>
    <desktop-nav
      :tabs="tabs"
      :activeTab="activeTab"
      @tabChange="changeActiveTab"
    ></desktop-nav>
    <mobile-nav
      :tabs="tabs"
      :activeTab="activeTab"
      @tabChange="changeActiveTab"
    ></mobile-nav>
    <div class="projects-container">
      <spinner v-if="loading"></spinner>
      <category-projects
        v-else
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
import axios from "axios";
import DesktopNav from "./DesktopNav.vue";
import MobileNav from "./MobileNav.vue";
export default {
  components: { Spinner, CategoryProjects, DesktopNav, MobileNav },
  data() {
    return {
      loading: false,
      tabs: [],
      activeTab: "",
      projects: [],
    };
  },
  created() {
    this.loading = true;
    axios
      .get("/api/project-categories")
      .then((response) => {
        this.tabs = response.data;
        this.activeTab = this.tabs[0]?.id;
      })
      .catch((error) => {
        console.log(error);
      });

    axios
      .get("/api/projects")
      .then((response) => {
        this.projects = response.data;
      })
      .catch((error) => {
        console.log(error);
      })
      .finally(() => {
        this.loading = false;
      });
  },
  methods: {
    changeActiveTab(selectedTab) {
      this.activeTab = selectedTab.id;
    },
  },
};
</script>
