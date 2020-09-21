<template>
  <div id="kt_aside" class="aside aside-left aside-fixed d-flex flex-column flex-row-auto">
    <KTBrand :logo="brandLogo"></KTBrand>
    <div id="kt_aside_menu_wrapper" class="aside-menu-wrapper flex-column-fluid">
      <KTAsideMenu></KTAsideMenu>
    </div>
  </div>
</template>

<script>
import KTBrand from './KTBrand.vue'
import KTAsideMenu from './KTAsideMenu.vue'

export default {
  name: 'KTAside',
  components: {
    KTBrand,
    KTAsideMenu
  },
  computed: {
    brandLogo () {
      return require('../assets/media/logos/logo-light.png')
    }
  }
}
</script>
