require('@/assets/plugins/global/plugins.bundle.js')
require('@/assets/js/scripts.bundle.js')
import Vue from 'vue'
import store from '@/store'
import router from '@/router'
import ApiService from '@/services/api.service.js'
import DefaultLayout from '@/layouts/Default.vue'
import EmptyLayout from '@/layouts/Empty.vue'
import App from '@/App.vue'

Vue.config.productionTip = false
ApiService.init()
Vue.component('default-layout', DefaultLayout)
Vue.component('empty-layout', EmptyLayout)

new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')
