<template>
  <div>
    <KTPageLoader :logo="pageLoaderLogo"></KTPageLoader>
    <KTHeaderMobile></KTHeaderMobile>
    <div class="d-flex flex-column flex-root">
      <div class="d-flex flex-row flex-column-fluid page">
        <KTAside></KTAside>
        <div id="kt_wrapper" class="d-flex flex-column flex-row-fluid wrapper">
          <KTHeader></KTHeader>
          <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
            <KTSubheader :pageTitle="pageTitle"></KTSubheader>
            <div class="d-flex flex-column-fluid">
              <div class="container">
                <router-view></router-view>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <KTQuickUser></KTQuickUser>
    <KTScrolltop></KTScrolltop>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import KTPageLoader from '../components/KTPageLoader.vue'
import KTHeaderMobile from '../components/KTHeaderMobile.vue'
import KTAside from '../components/KTAside.vue'
import KTHeader from '../components/KTHeader.vue'
import KTSubheader from '../components/KTSubheader.vue'
import KTQuickUser from '../components/KTQuickUser.vue'
import KTScrolltop from '../components/KTScrolltop.vue'

export default {
  components: {
    KTPageLoader,
    KTHeaderMobile,
    KTAside,
    KTHeader,
    KTSubheader,
    KTQuickUser,
    KTScrolltop
  },
  computed: {
    ...mapGetters([
      'pageTitle'
    ]),
    pageLoaderLogo () {
      return require('../assets/media/logos/logo-letter-13.png')
    }
  },
  beforeMount () {
    document.body.classList.add('page-loading')
  },
  mounted () {
    this.init()
    setTimeout(() => {
      document.body.classList.remove('page-loading')
    }, 2000)
  },
  methods: {
    init () {
      window.KTLayoutHeader.init('kt_header', 'kt_header_mobile')
      window.KTLayoutHeaderMenu.init('kt_header_menu', 'kt_header_menu_wrapper')
      window.KTLayoutHeaderTopbar.init('kt_header_mobile_topbar_toggle')
      window.KTLayoutBrand.init('kt_brand')
      window.KTLayoutAside.init('kt_aside')
      window.KTLayoutAsideToggle.init('kt_aside_toggle')
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
      window.KTLayoutQuickSearch.init('kt_quick_search')
      window.KTLayoutQuickCartPanel.init('kt_quick_cart')
      window.KTLayoutSearch().init('kt_quick_search_dropdown')
      window.KTLayoutSearchOffcanvas().init('kt_quick_search_offcanvas')
    }
  }
}
</script>
