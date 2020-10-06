<template>
  <div class="page-loader page-loader-logo">
    <img
      :src="logo"
      alt=""
      width="100px"
    >
    <div
      class="spinner"
      :class="spinnerClass"
    >
    </div>
  </div>
</template>

<script>
export default {
  name: "KTPageLoader",

  props: {
    logo: String,
    spinnerClass: {
      type: String,
      default: "spinner-primary"
    }
  }
}
</script>

<style lang="scss" scoped>
.page-loader {
  z-index: 9999 !important;
  overflow: hidden;
}
</style>
