<template>
  <div>
    <TheHeaderMobile/>
    <div class="d-flex flex-column flex-root">
      <div class="d-flex flex-row flex-column-fluid page">
        <TheAside/>
        <div
          id="kt_wrapper"
          class="d-flex flex-column flex-row-fluid wrapper"
        >
          <TheHeader/>
          <div
            id="kt_content"
            class="content d-flex flex-column flex-column-fluid"
          >
            <div class="d-flex flex-column-fluid">
              <div class="container">
                <router-view/>
              </div>
            </div>
          </div>
          <TheFooter/>
        </div>
      </div>
    </div>
    <TheScrolltop/>
    <TheQuickActions/>
    <TheQuickUser/>
    <TheQuickNotifications/>
  </div>
</template>

<script>
import TheHeaderMobile from './TheHeaderMobile.vue'
import TheAside from './TheAside.vue'
import TheHeader from './TheHeader'
import TheFooter from './TheFooter.vue'
import TheScrolltop from './TheScrolltop.vue'
import TheQuickActions from './TheQuickActions.vue'
import TheQuickUser from './TheQuickUser.vue'
import TheQuickNotifications from './TheQuickNotifications.vue'

export default {
  name: 'Layout',

  components: {
    TheHeaderMobile,
    TheAside,
    TheHeader,
    TheFooter,
    TheScrolltop,
    TheQuickActions,
    TheQuickUser,
    TheQuickNotifications
  },

  mounted () {
    this.$nextTick(() => {
      window.KTLayoutHeader.init('kt_header', 'kt_header_mobile')
      window.KTLayoutHeaderTopbar.init('kt_header_mobile_topbar_toggle')
      window.KTLayoutAside.init('kt_aside')
      window.KTLayoutAsideMenu.init('kt_aside_menu')
      window.KTLayoutSubheader.init('kt_subheader')
      window.KTLayoutContent.init('kt_content')
      window.KTLayoutFooter.init('kt_footer')
      window.KTLayoutScrolltop.init('kt_scrolltop')
      window.KTLayoutStickyCard.init('kt_page_sticky_card')
      window.KTLayoutStretchedCard.init('kt_page_stretched_card')
      window.KTLayoutExamples.init()
      window.KTLayoutDemoPanel.init('kt_demo_panel')
      window.KTLayoutChat.init()
      window.KTLayoutQuickActions.init('kt_quick_actions')
      window.KTLayoutQuickNotifications.init('kt_quick_notifications')
      window.KTLayoutQuickPanel.init('kt_quick_panel')
      window.KTLayoutQuickUser.init('kt_quick_user')
      window.KTLayoutSearchInline().init('kt_quick_search_inline')
      window.KTLayoutSearch().init('kt_quick_search_dropdown')
    })
  }
}
</script>
