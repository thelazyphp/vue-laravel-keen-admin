<template>
  <div
    id="kt_aside"
    class="aside aside-left d-flex flex-column flex-row-auto"
  >
    <div
      id="kt_aside_menu_wrapper"
      class="aside-menu-wrapper flex-column-fluid"
    >
      <TheAsideMenu/>
    </div>
  </div>
</template>

<script>
import TheAsideMenu from './TheAsideMenu.vue'

export default {
  name: 'TheAside',

  components: {
    TheAsideMenu
  }
}
</script>
