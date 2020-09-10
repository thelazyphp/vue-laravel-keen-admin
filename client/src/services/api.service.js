import Vue from 'vue'
import store from '@/store'
import Http from '@/plugins/Http.js'

export default {
  init () {
    Vue.use(Http, {
      baseURL: 'http://localhost/realty/api'
    })

    if (store.state.auth.token) {
      Vue.Http.setToken(store.state.auth.token)
    }
  },

  /**
   * @param {Object} credentials
   * @returns {Promise}
   */
  signIn (credentials) {
    return new Promise((resolve, reject) => {
      Vue.Http.post('/auth/login', credentials)
        .then(res => {
          Vue.Http.setToken(res.data.access_token)
          localStorage.setItem('token', res.data.access_token)
          return resolve(res)
        })
        .catch(error => reject(error))
    })
  },

  /**
   * @returns {Promise}
   */
  signOut () {
    return new Promise((resolve, reject) => {
      Vue.Http.post('/auth/logout')
        .then(res => {
          Vue.Http.removeToken()
          localStorage.removeItem('token')
          return resolve(res)
        })
        .catch(error => reject(error))
    })
  },

  /**
   * @param {Object} user
   * @returns {Promise}
   */
  signUp (user) {
    return new Promise((resolve, reject) => {
      Vue.Http.post('/users/register', user)
        .then(res => resolve(res))
        .catch(error => reject(error))
    })
  },

  /**
   * @param {(Number|String)} slug
   * @returns {Promise}
   */
  getUser (slug) {
    return new Promise((resolve, reject) => {
      Vue.Http.get(`/users/${slug}`)
        .then(res => resolve(res))
        .catch(error => reject(error))
    })
  },

  /**
   * @param {File} file
   * @returns {Promise}
   */
  uploadImage (file) {
    return new Promise((resolve, reject) => {
      const data = new FormData()
      data.append('file', file)

      Vue.Http.post('/images', data, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then(res => resolve(res))
      .catch(error => reject(error))
    })
  }
}
