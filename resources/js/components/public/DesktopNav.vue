<template>
  <div class="tabs desktop bg-primary py-2">
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
</template>

<script>
export default {
  props: {
    tabs: {
      type: Array,
      required: true,
    },
    activeTab: {
      required: true,
    },
  },

  methods: {
    selectTab(tab) {
      this.$emit("tabChange", tab);
    },
  },
};
</script>
