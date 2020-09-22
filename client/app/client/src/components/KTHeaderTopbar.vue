<template>
  <div class="topbar">
    <div class="topbar-item">
      <KTQuickUserToggle :user-name="userName"/>
    </div>
  </div>
</template>

<script>
import KTQuickUserToggle from './KTQuickUserToggle.vue'

export default {
  name: 'KTHeaderTopbar',
  components: {
    KTQuickUserToggle
  },
  computed: {
    userName () {
      return 'Денис'
    }
  }
}
</script>
