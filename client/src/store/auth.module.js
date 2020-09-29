import AuthService from "../services/auth.service.js"
import {
  SET_USER
} from "./index.js"

export const SET_TOKEN = "setToken"
export const LOGOUT = "logout"
export const LOGIN = "login"

export default {
  namespaced: true,
  state: {
    token: localStorage.getItem("token")
  },
  getters: {
    isAuthenticated (state) {
      return state.token !== null
    },
    token (state) {
      return state.token
    }
  },
  mutations: {
    [SET_TOKEN] (state, token) {
      state.token = token
    }
  },
  actions: {
    [LOGOUT] ({ commit }) {
      return new Promise((resolve, reject) => {
        AuthService.logout()
          .then(res => {
            commit(SET_TOKEN, null)
            commit(SET_USER, null, {
              root: true
            })
            return resolve(res)
          })
          .catch(error => {
            return reject(error)
          })
      })
    },
    [LOGIN] ({ commit }, credentials) {
      return new Promise((resolve, reject) => {
        AuthService.login(credentials)
          .then(res => {
            commit(SET_TOKEN, res.data.access_token)
            return resolve(res)
          })
          .catch(error => {
            return reject(error)
          })
      })
    }
  }
}
