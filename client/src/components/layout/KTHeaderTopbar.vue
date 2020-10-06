<template>
  <div class="topbar">
    <div class="topbar-item">
      <KTQuickUserToggle :user-name="user.first_name"/>
    </div>
  </div>
</template>

<script>
import KTQuickUserToggle from "./KTQuickUserToggle.vue"

export default {
  name: "KTHeaderTopbar",

  components: {
    KTQuickUserToggle
  },

  computed: {
    /**
     * @returns {object}
     */
    user () {
      return this.$store.getters.user
    }
  }
}
</script>
