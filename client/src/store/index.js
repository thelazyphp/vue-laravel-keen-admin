import Vue from "vue"
import Vuex from "vuex"
import ads from "./ads.module.js"
import auth from "./auth.module.js"
import UsersService from "../services/users.service.js"

Vue.use(Vuex)

export const SET_PAGE_TITLE = "setPageTitle"
export const SET_USER = "setUser"
export const FETCH_USER = "fetchUser"

export default new Vuex.Store({
  state: {
    pageTitle: "",
    user: null
  },
  getters: {
    pageTitle (state) {
      return state.pageTitle
    },
    user (state) {
      return state.user
    }
  },
  mutations: {
    [SET_PAGE_TITLE] (state, title) {
      state.pageTitle = title
      Vue.nextTick(() => {
        document.title = title
      })
    },
    [SET_USER] (state, user) {
      state.user = user
    }
  },
  actions: {
    [FETCH_USER] ({ commit }) {
      return new Promise((resolve, reject) => {
        UsersService.getSelf()
          .then(res => {
            commit(SET_USER, res.data.data)
            return resolve(res)
          })
          .catch(error => {
            return reject(error)
          })
      })
    }
  },
  modules: {
    ads,
    auth
  }
})
