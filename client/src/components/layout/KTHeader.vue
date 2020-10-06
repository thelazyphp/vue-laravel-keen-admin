<template>
  <div
    id="kt_header"
    class="header header-fixed"
  >
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
      <KTHeaderMenu/>
      <KTHeaderTopbar/>
    </div>
  </div>
</template>

<script>
import KTHeaderMenu from "./KTHeaderMenu.vue"
import KTHeaderTopbar from "./KTHeaderTopbar.vue"

export default {
  name: "KTHeader",

  components: {
    KTHeaderMenu,
    KTHeaderTopbar
  }
}
</script>
