<template>
  <router-view />
</template>

<script>
export default {
  mounted () {
    window.KTApp.init()
    window.KTLayout.init()
  }
}
</script>
