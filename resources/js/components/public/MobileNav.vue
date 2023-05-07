<template>
  <div class="tabs mobile bg-primary py-2">
    <div class="d-flex flex-column justify-content-center mb-0 p-0">
      <div class="tab-link-container my-1" v-for="tab in tabs" :key="tab.id">
        <a
          :class="{
            active: activeTab === tab.id,
            'tab-link': true,
          }"
          :href="'#' + tab.name.toLowerCase().replace(/ /g, '-')"
          v-text="tab.name"
          @click="selectTab(tab)"
        ></a>
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
