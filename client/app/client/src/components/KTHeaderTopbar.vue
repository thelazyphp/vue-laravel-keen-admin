<template>
  <div class="topbar">
    <div class="topbar-item">
      <KTQuickUserToggle :user-name="user.f_name"/>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex"
import KTQuickUserToggle from "./KTQuickUserToggle.vue"

export default {
  name: "KTHeaderTopbar",
  components: {
    KTQuickUserToggle
  },
  computed: {
    ...mapGetters([
      "user"
    ])
  }
}
</script>
