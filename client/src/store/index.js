import Vue from "vue"
import Vuex from "vuex"
import ads from "./ads.module.js"
import auth from "./auth.module.js"
import employees from "./employees.module.js"
import UsersService from "../services/users.service.js"

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    pageTitle: "",
    user: null
  },

  getters: {
    /**
     * @returns {string}
     */
    pageTitle (state) {
      return state.pageTitle
    },

    /**
     * @returns {object?}
     */
    user (state) {
      return state.user
    }
  },

  mutations: {
    /**
     * Stores page title.
     *
     * @param {string} title
     */
    setPageTitle (state, title) {
      state.pageTitle = title

      Vue.nextTick(() => {
        document.title = title + " | Realty"
      })
    },

    /**
     * Stores the authenticated user.
     *
     * @param {object?} user
     */
    setUser (state, user) {
      state.user = user
    }
  },

  actions: {
    /**
     * Retrives the authenticated user.
     */
    fetchUser ({ commit }) {
      return new Promise((resolve, reject) => {
        UsersService.get("self")
          .then(res => {
            commit("setUser", res.data.data)
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
    auth,
    employees,
  }
})
