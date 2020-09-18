<template>
  <div>
    <ThePageLoader></ThePageLoader>
    <router-view></router-view>
  </div>
</template>

<script>
import ThePageLoader from '../components/ThePageLoader.vue'

export default {
  components: {
    ThePageLoader
  },
  beforeMount () {
    document.body.classList.add('page-loading')
    setTimeout(() => {
      document.body.classList.remove('page-loading')
    }, 2000)
  }
}
</script>
