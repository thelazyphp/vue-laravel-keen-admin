import store from "../store"
import ApiService from "./api.service.js"

export const TOKEN_KEY = "token"

const AuthService = {
  init () {
    if (store.getters["auth/token"]) {
      this.setToken(store.getters["auth/token"])
    }
  },
  /**
   * @param {string} token
   */
  setToken (token) {
    localStorage.setItem(TOKEN_KEY, token)
    ApiService.setHeader("authorization", "Bearer " + token)
  },
  removeToken () {
    localStorage.removeItem(TOKEN_KEY)
    ApiService.removeHeader("authorization")
  },
  logout () {
    return new Promise((resolve, reject) => {
      ApiService.post("/auth/logout")
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
   * @param {object} credentials
   * @return {Promise}
   */
  login (credentials) {
    return new Promise((resolve, reject) => {
      ApiService.post("/auth/login", "", credentials)
        .then(res => {
          this.setToken(res.data.access_token)
          return resolve(res)
        })
        .catch(error => {
          return reject(error)
        })
    })
  }
}

export default AuthService
