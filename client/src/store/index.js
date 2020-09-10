import Vue from 'vue'
import Vuex from 'vuex'
import modules from './modules'
import ApiService from '@/services/api.service.js'

Vue.use(Vuex)

export default new Vuex.Store({
  modules,

  state: {
    user: null
  },

  mutations: {
    setUser (state, user) {
      state.user = user
    }
  },

  actions: {
    fetchUser ({ commit }) {
      return new Promise((resolve, reject) => {
        ApiService.getUser('self')
          .then(res => {
            commit('setUser', res.data.data)
            return resolve(res)
          })
          .catch(error => reject(error))
      })
    }
  }
})
