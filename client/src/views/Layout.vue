<template>
  <div>
    <KTPageLoader :logo="pageLoaderLogo"/>
    <KTHeaderMobile/>
    <div class="d-flex flex-column flex-root">
      <div class="d-flex flex-row flex-column-fluid page">
        <KTAside/>
        <div
          id="kt_wrapper"
          class="d-flex flex-column flex-row-fluid wrapper"
        >
          <KTHeader/>
          <div
            id="kt_content"
            class="content d-flex flex-column flex-column-fluid"
          >
            <KTSubheader :pageTitle="pageTitle"/>
            <div class="d-flex flex-column-fluid">
              <div class="container-fluid">
                <router-view/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <KTQuickUser/>
    <KTScrolltop/>
  </div>
</template>

<script>
import KTPageLoader from "../components/layout/KTPageLoader.vue"
import KTHeaderMobile from "../components/layout/KTHeaderMobile.vue"
import KTAside from "../components/layout/KTAside.vue"
import KTHeader from "../components/layout/KTHeader.vue"
import KTSubheader from "../components/layout/KTSubheader.vue"
import KTQuickUser from "../components/layout/KTQuickUser.vue"
import KTScrolltop from "../components/layout/KTScrolltop.vue"

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
    /**
     * @returns {*}
     */
    pageLoaderLogo () {
      return require("../assets/media/logos/logo-letter-13.png")
    },

    /**
     * @returns {string}
     */
    pageTitle () {
      return this.$store.getters.pageTitle
    }
  },

  beforeMount () {
    document.body.classList.add("page-loading")
  },

  mounted () {
    const timeout = setTimeout(() => {
      document.body.classList.remove("page-loading")
      clearTimeout(timeout)
    }, 1000)

    this.$nextTick(() => {
      window.KTLayoutHeader.init("kt_header", "kt_header_mobile")
      window.KTLayoutContent.init("kt_content")
      window.KTLayoutFooter.init("kt_footer")
      window.KTLayoutStickyCard.init("kt_page_sticky_card")
      window.KTLayoutStretchedCard.init("kt_page_stretched_card")
      window.KTLayoutExamples.init()
      window.KTLayoutDemoPanel.init("kt_demo_panel")
      window.KTLayoutChat.init()
      window.KTLayoutQuickActions.init("kt_quick_actions")
      window.KTLayoutQuickNotifications.init("kt_quick_notifications")
      window.KTLayoutQuickPanel.init("kt_quick_panel")
      window.KTLayoutQuickSearch.init("kt_quick_search")
      window.KTLayoutQuickCartPanel.init("kt_quick_cart")
      window.KTLayoutSearch().init("kt_quick_search_dropdown")
      window.KTLayoutSearchOffcanvas().init("kt_quick_search_offcanvas")
    })
  }
}
</script>
