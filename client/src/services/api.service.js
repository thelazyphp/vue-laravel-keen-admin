import Vue   from 'vue'
import Http  from '@/plugins/Http.js'
import store from '@/store'

export default {
  init () {
    Vue.use(Http, {
      baseURL: 'http://localhost/realty/api/v1'
    })

    if (!!store.state.auth.token) {
      Vue.Http.setToken(store.state.auth.token)
    }
  },

  /**
   * @param {Object} credentials
   * @returns {Object}
   */
  async signIn (credentials) {
    try {
      const res = await Vue.Http.post('/auth/login', credentials)
      Vue.Http.setToken(res.data.access_token)
      localStorage.setItem('token', res.data.access_token)

      return res
    } catch (error) {
      //
    }
  },

  async signOut () {
    try {
      await Vue.Http.post('/auth/logout')
      Vue.Http.removeToken()
      localStorage.removeItem('token')
    } catch (error) {
      //
    }
  },

  /**
   * @param {Object} user
   * @returns {Object}
   */
  async signUp (user) {
    await Vue.Http.post('/auth/register', user)
  },

  /**
   * @param {?Object} [params={}]
   * @returns {Object}
   */
  async getUsers (params = {}) {
    return await Vue.Http.get('/users', { params })
  },

  /**
   * @param {(Number|String)} id
   * @returns {Object}
   */
  async getUser (id) {
    return await Vue.Http.get(`/users/${id}`)
  },

  /**
   * @param {(Number|String)} id
   */
  async removeUser (id) {
    await Vue.Http.delete(`/users/${id}`)
  },

  /**
   * @param {Object} user
   * @returns {Object}
   */
  async createUser (user) {
    return await Vue.Http.post('/users', user)
  },

  /**
   * @param {(Number|String)} id
   * @param {Object} user
   * @returns {Object}
   */
  async updateUser (id, user) {
    return await Vue.Http.put(`/users/${id}`, user)
  },

  /**
   * @returns {Object}
   */
  async getCurrentUser () {
    return await this.getUser('self')
  },

  async removeCurrentUser () {
    return await this.removeUser('self')
  },

  /**
   * @param {Object} user
   * @returns {Object}
   */
  async updateCurrentUser (user) {
    return await this.updateUser('self', user)
  },

  /**
   * @param {File} file
   * @returns {Object}
   */
  async uploadImage (file) {
    const formData = new FormData()
    formData.append('file', file)

    return await Vue.Http.post('/images', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
  },

  /**
   * @returns {Object}
   */
  async getOptions () {
    return await Vue.Http.get('/options')
  },

  /**
   * @param {?Object} [params={}]
   * @returns {Object}
   */
  async getAds (params = {}) {
    return await Vue.Http.get(`/ads`, { params })
  },

  /**
   * @param {String} name
   * @returns {Object}
   */
  async createCompany (name) {
    return await Vue.Http.post('/companies', { name })
  },

  /**
   * @param {Number} id
   * @param {Object} company
   * @returns {Object}
   */
  async updateCompany (company) {
    return await Vue.Http.put(`/companies/${id}`, company)
  }
}
