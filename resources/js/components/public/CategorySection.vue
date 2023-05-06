<template>
  <div>
    <div class="tabs bg-primary py-2">
      <div class="d-flex justify-content-center mb-0 p-0">
        <div
          class="tab-link-container d-flex"
          v-for="(tab, index) in tabs"
          :key="tab.id"
        >
          <a
            :class="{
              active: activeTab === tab.id,
              'tab-link': true,
            }"
            :href="'#' + tab.name.toLowerCase().replace(/ /g, '-')"
            v-text="tab.name"
            @click="selectTab(tab)"
          ></a>
          <div class="tab-divider" v-if="index != tabs.length - 1"></div>
        </div>
      </div>
    </div>
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
export default {
  components: { Spinner, CategoryProjects },
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
    selectTab(selectedTab) {
      this.activeTab = selectedTab.id;
    },
  },
};
</script>
