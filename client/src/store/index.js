import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth.js'
import Users from '../services/users.js'

Vue.use(Vuex)

export const SET_USER = 'setUser'
export const FETCH_USER = 'fetchUser'

export default new Vuex.Store({
  modules: {
    auth
  },

  state: {
    user: null
  },

  mutations: {
    [SET_USER] (state, user) {
      state.user = user
    }
  },

  actions: {
    [FETCH_USER] ({ commit }) {
      return new Promise((resolve, reject) => {
        Users.getSelf()
          .then(res => {
            commit(SET_USER, res.data)
            return resolve(res)
          })
          .catch(error => {
            return reject(error)
          })
      })
    }
  }
})
