<template>
  <div id="kt_header_mobile" class="kt-header-mobile kt-header-mobile--fixed">
		<div class="kt-header-mobile__logo">
			<router-link :to="{ name: 'home' }">
				<img src="@/assets/media/logos/logo-6.png" alt="">
			</router-link>
		</div>
		<div class="kt-header-mobile__toolbar">
			<button id="kt_aside_mobile_toggler" type="button" class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left">
        <span></span>
      </button>
			<button id="kt_header_mobile_topbar_toggler" type="button" class="kt-header-mobile__toolbar-topbar-toggler">
        <i class="flaticon-more"></i>
      </button>
		</div>
	</div>
</template>

<script>
export default {
  name: 'TheHeaderMobile'
}
</script>
