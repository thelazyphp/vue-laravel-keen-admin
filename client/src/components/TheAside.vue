<template>
  <div id="kt_aside" class="kt-aside kt-aside--fixed kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop">
		<div id="kt_aside_brand" class="kt-aside__brand kt-grid__item">
			<div class="kt-aside__brand-logo">
				<router-link to="/">
					<img src="@/assets/media/logos/logo-6.png" alt="">
				</router-link>
			</div>
			<div class="kt-aside__brand-tools">
				<button id="kt_aside_toggler" type="button" class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left">
          <span></span>
        </button>
			</div>
		</div>
		<TheAsideMenu />
	</div>
</template>

<script>
import TheAsideMenu from './TheAsideMenu.vue'

export default {
  name: 'TheAside',

  components: {
    TheAsideMenu
  }
}
</script>
