import Vue from "vue"
import App from "./App.vue"
import router from "./router"
import store from "./store"
import ApiService from "./services/api.service.js"
import AuthService from "./services/auth.service.js"

window.jQuery = window.$ = require("jquery")
require("bootstrap")
window.Popper = require("popper.js").default
window.wNumb = require("wnumb")
window.moment = require("moment")
require("es6-shim/es6-shim.min.js")
window.PerfectScrollbar = require("perfect-scrollbar/dist/perfect-scrollbar")
window.Sticky = require("sticky-js")
window.ApexCharts = require("apexcharts/dist/apexcharts.min.js")
window.FormValidation = require("./assets/plugins/formvalidation/dist/amd/index.js")
window.FormValidation.plugins.Bootstrap = require("./assets/plugins/formvalidation/dist/amd/plugins/Bootstrap.js").default
require("block-ui/jquery.blockUI.js")
require("tempusdominus-bootstrap-4")
require("bootstrap-datepicker/dist/js/bootstrap-datepicker.js")
require("./assets/js/vendors/plugins/bootstrap-datepicker.init.js")
require("bootstrap-timepicker/js/bootstrap-timepicker.js")
require("./assets/js/vendors/plugins/bootstrap-timepicker.init.js")
require("bootstrap-daterangepicker/daterangepicker.js")
require("bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js")
require("bootstrap-maxlength/src/bootstrap-maxlength.js")
require("./assets/plugins/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js")
require("bootstrap-select/dist/js/bootstrap-select.js")
require("bootstrap-switch/dist/js/bootstrap-switch.js")
require("./assets/js/vendors/plugins/bootstrap-switch.init.js")
require("select2/dist/js/select2.full.js")
require("ion-rangeslider/js/ion.rangeSlider.js")
window.Bloodhound = require("typeahead.js/dist/typeahead.bundle.js")
window.Handlebars = require("handlebars/dist/handlebars.js")
require("inputmask/dist/jquery.inputmask.bundle.js")
require("inputmask/dist/inputmask/inputmask.date.extensions.js")
require("inputmask/dist/inputmask/inputmask.numeric.extensions.js")
window.noUiSlider = require("nouislider/distribute/nouislider.js")
require("owl.carousel/dist/owl.carousel")
window.autosize = require("autosize/dist/autosize.js")
window.ClipboardJS = require("clipboard/dist/clipboard.min.js")
window.Dropzone = require("dropzone/dist/dropzone.js")
require("./assets/js/vendors/plugins/dropzone.init.js")
window.Quill = require("quill/dist/quill.js")
require("@yaireo/tagify/dist/tagify.polyfills.min")
window.Tagify = require("@yaireo/tagify/dist/tagify.min")
require("summernote/dist/summernote.js")
require("markdown/lib/markdown.js")
require("bootstrap-markdown/js/bootstrap-markdown.js")
require("./assets/js/vendors/plugins/bootstrap-markdown.init.js")
require("bootstrap-notify/bootstrap-notify.min.js")
require("./assets/js/vendors/plugins/bootstrap-notify.init.js")
window.toastr = require("toastr/build/toastr.min.js")
window.DualListbox = require("dual-listbox").default
window.sessionTimeout = require("./assets/plugins/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js")
require("./assets/plugins/jquery-idletimer/idle-timer.min.js")
require("waypoints/lib/jquery.waypoints.js")
require("counterup/jquery.counterup.js")
require("es6-promise-polyfill/promise.min.js")
window.Swal = window.swal = require("sweetalert2/dist/sweetalert2.min.js")
require("./assets/js/vendors/plugins/sweetalert2.init.js")
require("jquery.repeater")

window.KTAppSettings = {
  "breakpoints": {
    "sm": 576,
    "md": 768,
    "lg": 992,
    "xl": 1200,
    "xxl": 1400
  },
  "colors": {
    "theme": {
      "base": {
          "white": "#ffffff",
          "primary": "#3699FF",
          "secondary": "#E5EAEE",
          "success": "#1BC5BD",
          "info": "#8950FC",
          "warning": "#FFA800",
          "danger": "#F64E60",
          "light": "#E4E6EF",
          "dark": "#181C32"
      },
      "light": {
          "white": "#ffffff",
          "primary": "#E1F0FF",
          "secondary": "#EBEDF3",
          "success": "#C9F7F5",
          "info": "#EEE5FF",
          "warning": "#FFF4DE",
          "danger": "#FFE2E5",
          "light": "#F3F6F9",
          "dark": "#D6D6E0"
      },
      "inverse": {
          "white": "#ffffff",
          "primary": "#ffffff",
          "secondary": "#3F4254",
          "success": "#ffffff",
          "info": "#ffffff",
          "warning": "#ffffff",
          "danger": "#ffffff",
          "light": "#464E5F",
          "dark": "#ffffff"
      }
    },
    "gray": {
      "gray-100": "#F3F6F9",
      "gray-200": "#EBEDF3",
      "gray-300": "#E4E6EF",
      "gray-400": "#D1D3E0",
      "gray-500": "#B5B5C3",
      "gray-600": "#7E8299",
      "gray-700": "#5E6278",
      "gray-800": "#3F4254",
      "gray-900": "#181C32"
    }
  },
  "font-family": "Poppins"
}

window.KTUtil = require("./assets/js/components/util.js")
window.KTApp = require("./assets/js/components/app.js")
window.KTCard = require("./assets/js/components/card.js")
window.KTCookie = require("./assets/js/components/cookie.js")
window.KTDialog = require("./assets/js/components/dialog.js")
window.KTHeader = require("./assets/js/components/header.js")
window.KTImageInput = require("./assets/js/components/image-input.js")
window.KTMenu = require("./assets/js/components/menu.js")
window.KTOffcanvas = require("./assets/js/components/offcanvas.js")
window.KTScrolltop = require("./assets/js/components/scrolltop.js")
window.KTToggle = require("./assets/js/components/toggle.js")
window.KTWizard = require("./assets/js/components/wizard.js")
require("./assets/js/components/datatable/core.datatable.js")
require("./assets/js/components/datatable/datatable.checkbox.js")
require("./assets/js/components/datatable/datatable.rtl.js")
window.KTLayoutAside = require("./assets/js/layout/base/aside.js")
window.KTLayoutAsideMenu = require("./assets/js/layout/base/aside-menu.js")
window.KTLayoutAsideToggle = require("./assets/js/layout/base/aside-toggle.js")
window.KTLayoutBrand = require("./assets/js/layout/base/brand.js")
window.KTLayoutContent = require("./assets/js/layout/base/content.js")
window.KTLayoutFooter = require("./assets/js/layout/base/footer.js")
window.KTLayoutHeader = require("./assets/js/layout/base/header.js")
window.KTLayoutHeaderMenu = require("./assets/js/layout/base/header-menu.js")
window.KTLayoutHeaderTopbar = require("./assets/js/layout/base/header-topbar.js")
window.KTLayoutStickyCard = require("./assets/js/layout/base/sticky-card.js")
window.KTLayoutStretchedCard = require("./assets/js/layout/base/stretched-card.js")
window.KTLayoutSubheader = require("./assets/js/layout/base/subheader.js")
window.KTLayoutChat = require("./assets/js/layout/extended/chat.js")
window.KTLayoutDemoPanel = require("./assets/js/layout/extended/demo-panel.js")
window.KTLayoutExamples = require("./assets/js/layout/extended/examples.js")
window.KTLayoutQuickActions = require("./assets/js/layout/extended/quick-actions.js")
window.KTLayoutQuickCartPanel = require("./assets/js/layout/extended/quick-cart.js")
window.KTLayoutQuickNotifications = require("./assets/js/layout/extended/quick-notifications.js")
window.KTLayoutQuickPanel = require("./assets/js/layout/extended/quick-panel.js")
window.KTLayoutQuickSearch = require("./assets/js/layout/extended/quick-search.js")
window.KTLayoutQuickUser = require("./assets/js/layout/extended/quick-user.js")
window.KTLayoutScrolltop = require("./assets/js/layout/extended/scrolltop.js")
window.KTLayoutSearch = window.KTLayoutSearchOffcanvas = require("./assets/js/layout/extended/search.js")

Vue.config.productionTip = false

ApiService.init()
AuthService.init()

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app")
