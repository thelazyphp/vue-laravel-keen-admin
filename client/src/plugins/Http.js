import axios from 'axios'

export default {
  install (Vue, options) {
    Vue.Http = Vue.prototype.$http = axios.create({
      baseURL: options.baseURL,
      headers: {
        'accept': 'application/json',
        'content-type': 'application/json'
      }
    })

    Vue.Http.removeToken = Vue.prototype.$http.removeToken = function () {
      delete Vue.Http.defaults.headers.common['authorization']
    }

    Vue.Http.setToken = Vue.prototype.$http.setToken = function (token) {
      Vue.Http.defaults.headers.common['authorization'] = `Bearer ${token}`
    }
  }
}
