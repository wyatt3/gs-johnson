<template>
  <div class="tabs mobile bg-primary py-2" :class="{ open }">
    <div class="d-flex flex-column justify-content-center mb-0 p-0">
      <div
        class="tab-link-container my-1"
        v-for="tab in tabs"
        :key="tab.id"
        :class="{ active: activeTab === tab.id }"
      >
        <a
          :class="{
            active: activeTab === tab.id,
            'tab-link': true,
          }"
          :href="'#' + tab.name.toLowerCase().replace(/ /g, '-')"
          v-text="tab.name"
          @click="open ? selectTab(tab) : openNav()"
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
  data() {
    return {
      open: false,
    };
  },
  methods: {
    selectTab(tab) {
      this.open = false;
      this.$emit("tabChange", tab);
    },
    openNav() {
      this.open = true;
    },
  },
};
</script>
