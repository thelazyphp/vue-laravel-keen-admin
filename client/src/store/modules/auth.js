import ApiService from '@/services/api.service.js'

export default {
  namespaced: true,

  state: {
    token: localStorage.getItem('token')
  },

  getters: {
    isAuthenticated (state) {
      return !!state.token
    }
  },

  mutations: {
    setToken (state, token) {
      state.token = token
    }
  },

  actions: {
    signIn ({ commit }, credentials) {
      return new Promise((resolve, reject) => {
        ApiService.signIn(credentials)
          .then(res => {
            commit('setToken', res.data.access_token)
            return resolve(res)
          })
          .catch(error => reject(error))
      })
    },

    signOut ({ commit }) {
      return new Promise((resolve, reject) => {
        ApiService.signOut()
          .then(res => {
            commit('setToken', null)
            commit('setUser', null, { root: true })
            return resolve(res)
          })
          .catch(error => reject(error))
      })
    }
  }
}
