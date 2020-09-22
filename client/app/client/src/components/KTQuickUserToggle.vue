<template>
  <div
    id="kt_quick_user_toggle"
    class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
  >
    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Привет,</span>
    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ userName }}</span>
    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
      <span class="symbol-label font-size-h5 font-weight-bold">{{ symbolLabelText }}</span>
    </span>
  </div>
</template>

<script>
export default {
  name: "KTQuickUserToggle",
  props: {
    userName: {
      type: String,
      default: ""
    }
  },
  computed: {
    symbolLabelText () {
      return this.userName.substr(0, 1)
    }
  }
}
</script>
