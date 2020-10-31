<template>
  <div
    id="kt_quick_notifications"
    class="offcanvas offcanvas-right p-10"
  >
    <div class="offcanvas-header d-flex align-items-center justify-content-between mb-10">
      <h3 class="font-weight-bold m-0">
        Уведомления
        <small class="text-muted font-size-sm ml-2">1 новое</small>
      </h3>
      <a
        id="kt_quick_notifications_close"
        href=""
        role="button"
        class="btn btn-xs btn-icon btn-light btn-hover-primary"
      >
        <i class="ki ki-close icon-xs text-muted"></i>
      </a>
    </div>
    <div class="offcanvas-content pr-5 mr-n5">
      <!-- -->
    </div>
  </div>
</template>

<script>
export default {
  name: 'TheQuickNotifications',

  methods: {
    /**
     * Closes the offcanvas.
     */
    closeOffcanvas () {
      document.getElementById('kt_quick_notifications_close').click()
    }
  }
}
</script>
