require('@/assets/plugins/global/plugins.bundle.js')
require("@/assets/js/scripts.bundle.js")

import Vue from 'vue'
import App from '@/App.vue'
import store from '@/store'
import router from '@/router'
import Vuelidate from 'vuelidate'
import ApiService from '@/services/api.service.js'

Vue.config.productionTip = false
Vue.use(Vuelidate)
ApiService.init()

new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')
