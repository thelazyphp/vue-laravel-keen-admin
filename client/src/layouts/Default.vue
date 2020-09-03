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
						<TheSubheader>{{ $route.meta.title || '' }}</TheSubheader>
						<div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
              <router-view />
            </div>
					</div>
				</div>
			</div>
		</div>
    <TheQuickPanel />
		<TheQuickActions />
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="la la-arrow-up"></i>
		</div>
  </div>
</template>

<script>
import TheHeaderMobile from '@/components/TheHeaderMobile.vue'
import TheAside        from '@/components/TheAside.vue'
import TheHeader       from '@/components/TheHeader.vue'
import TheSubheader    from '@/components/TheSubheader.vue'
import TheQuickPanel   from '@/components/TheQuickPanel.vue'
import TheQuickActions from '@/components/TheQuickActions.vue'

export default {
  components: {
    TheHeaderMobile,
    TheAside,
    TheHeader,
    TheSubheader,
    TheQuickPanel,
    TheQuickActions
  },

  mounted () {
    document.body.setAttribute('class', 'kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading')
  }
}
</script>
