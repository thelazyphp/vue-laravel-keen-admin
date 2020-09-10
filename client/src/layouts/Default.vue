<template>
  <div>
    <TheHeaderMobile />
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
				<button id="kt_aside_close_btn" type="button" class="kt-aside-close">
          <i class="la la-close"></i>
        </button>
        <TheAside />
				<div id="kt_wrapper" class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper">
					<TheHeader />
					<div id="kt_content" class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
            <TheSubheader v-if="$route.meta.subheader">
              <component :is="$route.meta.subheader" />
            </TheSubheader>
						<div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
              <router-view />
            </div>
					</div>
				</div>
			</div>
		</div>
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="la la-arrow-up"></i>
		</div>
  </div>
</template>

<script>
import TheHeaderMobile from '@/components/TheHeaderMobile.vue'
import TheAside from '@/components/TheAside.vue'
import TheHeader from '@/components/TheHeader.vue'
import TheSubheader from '@/components/TheSubheader'
import TheEditProfileSubheader from '@/components/TheSubheader/EditProfile.vue'

export default {
  components: {
    TheHeaderMobile,
    TheAside,
    TheHeader,
    TheSubheader,
    TheEditProfileSubheader
  },

  beforeMount () {
    document.body.setAttribute(
      'class',
      'kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading'
    )
  },

  mounted () {
    window.KTApp.init()
    window.KTLayout.init()
  }
}
</script>
