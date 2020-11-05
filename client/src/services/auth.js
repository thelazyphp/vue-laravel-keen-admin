import axios from 'axios'
import store from '../store'
import router from '../router'

const Auth = {
  /**
   * Inits the auth service.
   */
  init () {
    axios.interceptors
      .request
      .use(req => {
        if (store.getters.isAuthenticated) {
          req.headers['authorization'] = this.header()
        }

        return req
      }, error => {
        return Promise.reject(error)
      })

    axios.interceptors
      .response
      .use(res => {
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
   * Returns the auth HTTP header value.
   *
   * @returns {string}
   */
  header () {
    return `Bearer ${store.state.authToken}`
  }
}

export default Auth
