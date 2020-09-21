<template>
  <div id="kt_header" class="header header-fixed">
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
      <div></div>
      <div class="topbar">
        <div class="topbar-item">
          <div id="kt_quick_user_toggle" class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2">
            <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Привет,</span>
            <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">Денис</span>
            <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
              <span class="symbol-label font-size-h5 font-weight-bold">Д</span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'KTHeader'
}
</script>
