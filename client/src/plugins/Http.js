import axios from 'axios'

export default {
  install (Vue, options) {
    Vue.Http = Vue.prototype.$http = axios.create({
      baseURL: options.baseURL,

      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      }
    })

    Vue.Http.removeToken = Vue.prototype.$http.removeToken = function () {
      delete Vue.Http.defaults.headers.common['Authorization']
    }

    Vue.Http.setToken = Vue.prototype.$http.setToken = function (token) {
      Vue.Http.defaults.headers.common['Authorization'] = `Bearer ${token}`
    }
  }
}
