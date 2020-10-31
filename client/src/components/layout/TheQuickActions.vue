<template>
  <div
    id="kt_quick_actions"
    class="offcanvas offcanvas-right p-10"
  >
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-10">
      <h3 class="font-weight-bold m-0">Быстрые действия</h3>
      <a
        id="kt_quick_actions_close"
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
  name: 'TheQuickActions',

  methods: {
    /**
     * Closes the offcanvas.
     */
    closeOffcanvas () {
      document.getElementById('kt_quick_actions_close').click()
    }
  }
}
</script>
