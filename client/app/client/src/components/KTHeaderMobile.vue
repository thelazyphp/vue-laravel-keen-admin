<template>
  <div
    id="kt_header_mobile"
    class="header-mobile align-items-center header-mobile-fixed"
  >
    <router-link to="/">
      <img
        :src="logo"
        alt=""
      >
    </router-link>
    <div class="d-flex align-items-center">
      <KTAsideMobileToggle/>
      <KTHeaderMobileTopbarToggle/>
    </div>
  </div>
</template>

<script>
import KTAsideMobileToggle from "./KTAsideMobileToggle.vue"
import KTHeaderMobileTopbarToggle from "./KTHeaderMobileTopbarToggle.vue"

export default {
  name: "KTHeaderMobile",
  components: {
    KTAsideMobileToggle,
    KTHeaderMobileTopbarToggle
  },
  computed: {
    logo () {
      return require("../assets/media/logos/logo-light.png")
    }
  }
}
</script>
