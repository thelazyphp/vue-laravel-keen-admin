<template>
  <component :is="layout" />
</template>

<script>
import DefaultLayout from '@/layouts/Default.vue'
import EmptyLayout   from '@/layouts/Empty.vue'

export default {
  components: {
    DefaultLayout,
    EmptyLayout
  },

  computed: {
    layout () {
      return `${this.$route.meta.layout || 'default'}-layout`
    }
  },

  mounted () {
    require('@/assets/js/scripts.bundle.js')
  }
}
</script>

<style lang="scss">
@import '@/assets/sass/style.scss';
@import '@/assets/sass/global/layout/header/skins/base/light.scss';
@import '@/assets/sass/global/layout/header/skins/menu/light.scss';
@import '@/assets/sass/global/layout/brand/skins/navy.scss';
@import '@/assets/sass/global/layout/aside/skins/navy.scss';
</style>
