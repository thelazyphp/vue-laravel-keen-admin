import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

// mutation types:
export const SET_AUTH_TOKEN = 'setAuthToken'
export const SET_USER = 'setUser'
export const SET_PAGE_TITLE = 'setPageTitle'
export const SET_PAGE_IS_LOADING = 'setPageIsLoading'

// action types:
export const LOGIN = 'login'
export const LOGOUT = 'logout'
export const FETCH_USER = 'fetchUser'

Vue.use(Vuex)

const AUTH_TOKEN_KEY = 'authToken'
const PAGE_TITLE_PATTERN = 'Realty | {title}'
const PAGE_LOADING_TIMEOUT = 2000

export default new Vuex.Store({
  state: {
    authToken: window.localStorage.getItem(AUTH_TOKEN_KEY),
    user: null,
    pageTitle: '',
    pageIsLoading: false
  },

  getters: {
    isAuthenticated: state => !!state.authToken
  },

  mutations: {
    [SET_AUTH_TOKEN] (state, token) {
      state.authToken = token
    },

    [SET_USER] (state, user) {
      state.user = user
    },

    [SET_PAGE_TITLE] (state, title) {
      state.title = PAGE_TITLE_PATTERN.replace('{title}', title)

      Vue.nextTick(() => {
        document.title = state.title
      })
    },

    [SET_PAGE_IS_LOADING] (state, isLoading) {
      state.pageIsLoading = isLoading

      const timeout = setTimeout(() => {
        clearTimeout(timeout)

        if (state.pageIsLoading) {
          state.pageIsLoading = false
        }
      }, PAGE_LOADING_TIMEOUT)
    }
  },

  actions: {
    [LOGIN] ({ commit }, data) {
      return new Promise((resolve, reject) => {
        axios.post('/auth/token', data)
          .then(res => {
            const token = res.data.access_token
            commit(SET_AUTH_TOKEN, token)
            window.localStorage.setItem(AUTH_TOKEN_KEY, token)
            return resolve(res)
          })
          .catch(error => {
            return reject(error)
          })
      })
    },

    [LOGOUT] ({ commit }) {
      return new Promise((resolve, reject) => {
        axios.post('/auth/logout')
          .then(res => {
            commit(SET_AUTH_TOKEN, null)
            commit(SET_USER, null)
            window.localStorage.removeItem(AUTH_TOKEN_KEY)
            return resolve(res)
          })
          .catch(error => {
            return reject(error)
          })
      })
    },

    [FETCH_USER] ({ commit }) {
      return new Promise((resolve, reject) => {
        axios.get('/users/self')
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
