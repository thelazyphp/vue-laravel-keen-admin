<template>
  <div
    id="kt_brand"
    class="brand flex-column-auto"
  >
    <router-link
      to="/"
      class="brand-logo"
    >
      <img
        :src="logo"
        alt=""
      >
    </router-link>
    <KTAsideToggle/>
  </div>
</template>

<script>
import KTAsideToggle from "./KTAsideToggle.vue"

export default {
  name: "KTBrand",
  components: {
    KTAsideToggle
  },
  props: {
    logo: String
  },
  mounted () {
    this.$nextTick(() => {
      window.KTLayoutBrand.init("kt_brand")
    })
  }
}
</script>
