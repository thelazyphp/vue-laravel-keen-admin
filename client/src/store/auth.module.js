import AuthService from "../services/auth.service.js"

export default {
  namespaced: true,

  state: {
    token: localStorage.getItem("token")
  },

  getters: {
    /**
     * @returns {string?}
     */
    token (state) {
      return state.token
    },

    /**
     * @returns {boolean}
     */
    isAuthenticated (state) {
      return state.token !== null
    }
  },

  mutations: {
    /**
     * Stores the auth token.
     *
     * @param {string?} token
     */
    setToken (state, token) {
      state.token = token
    }
  },

  actions: {
    /**
     * Logs the user in.
     *
     * @param {object} credentials
     */
    login ({ commit }, credentials) {
      return new Promise((resolve, reject) => {
        AuthService.login(credentials)
          .then(res => {
            commit("setToken", res.data.access_token)
            return resolve(res)
          })
          .catch(error => {
            return reject(error)
          })
      })
    },

    /**
     * Logs the user out.
     */
    logout ({ commit }) {
      return new Promise((resolve, reject) => {
        AuthService.logout()
          .then(res => {
            commit("setToken", null)

            commit("setUser", null, {
              root: true
            })

            return resolve(res)
          })
          .catch(error => {
            return reject(error)
          })
      })
    }
  }
}
