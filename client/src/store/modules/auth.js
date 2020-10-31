import { SET_USER } from '../index.js'
import Auth from '../../services/auth.js'

export const AUTHENTICATE = 'authenticate'
export const UNAUTHENTICATE = 'unauthenticate'
export const LOGIN = 'login'
export const LOGOUT = 'logout'

const state = {
  isAuthenticated: Auth.isAuthenticated()
}

const mutations = {
  [AUTHENTICATE] (state) {
    state.isAuthenticated = true
  },

  [UNAUTHENTICATE] (state) {
    state.isAuthenticated = false
  }
}

const actions = {
  [LOGIN] ({ commit }, data) {
    return new Promise((resolve, reject) => {
      Auth.login(data)
        .then(res => {
          commit(AUTHENTICATE)
          return resolve(res)
        })
        .catch(error => {
          return reject(error)
        })
    })
  },

  [LOGOUT] ({ commit }) {
    return new Promise((resolve, reject) => {
      Auth.logout()
        .then(res => {
          commit(UNAUTHENTICATE)

          commit(SET_USER, null, {
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

export default {
  state,
  mutations,
  actions,
  namespaced: true
}
