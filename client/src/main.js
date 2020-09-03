require('@/assets/plugins/global/plugins.bundle.js')

import Vue        from 'vue'
import ApiService from '@/services/api.service.js'
import store      from '@/store'
import router     from '@/router'
import App        from '@/App.vue'

Vue.config.productionTip = false
ApiService.init()

new Vue({
  store,
  router,
  render: h => h(App)
}).$mount('#app')
