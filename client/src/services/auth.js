import axios from 'axios'
import router from '../router'

const TOKEN_KEY = 'token'

const Auth = {
  /**
   * Inits the auth service.
   */
  init () {
    this.addInterceptors()
  },

  /**
   * Adds interceptors.
   */
  addInterceptors () {
    axios.interceptors.request.use(req => {
      if (this.isAuthenticated()) {
        req.headers['Authorization'] = `Bearer ${this.getToken()}`
      }

      return req
    }, error => {
      return Promise.reject(error)
    })

    axios.interceptors.response.use(res => {
      return res
    }, error => {
      if (error.response.status === 401) {
        router.push({
          name: 'Login'
        })
      }

      return Promise.reject(error)
    })
  },

  /**
   * Retrieves the auth token from the storage.
   *
   * @returns {string?}
   */
  getToken () {
    return window.localStorage.getItem(TOKEN_KEY)
  },

  /**
   * Checks if the user is authenticated.
   *
   * @returns {boolean}
   */
  isAuthenticated () {
    return !!this.getToken()
  },

  /**
   * Removes the auth token from the storage.
   */
  removeToken () {
    window.localStorage.removeItem(TOKEN_KEY)
  },

  /**
   * Stores the auth token to the storage.
   *
   * @param {string} token - The auth token
   */
  storeToken (token) {
    window.localStorage.setItem(TOKEN_KEY, token)
  },

  /**
   * Logs the user out.
   *
   * @returns {Promise}
   */
  logout () {
    return new Promise((resolve, reject) => {
      axios.post('/auth/logout')
        .then(res => {
          this.removeToken()
          return resolve(res)
        })
        .catch(error => {
          return reject(error)
        })
    })
  },

  /**
   * Logs the user in.
   *
   * @param {object} data - The user data
   * @returns {Promise}
   */
  login (data) {
    return new Promise((resolve, reject) => {
      axios.post('/auth/token', data)
        .then(res => {
          this.storeToken(res.data.access_token)
          return resolve(res)
        })
        .catch(error => {
          return reject(error)
        })
    })
  }
}

export default Auth
