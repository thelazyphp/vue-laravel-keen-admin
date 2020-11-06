import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import {
  SET_AUTH_TOKEN,
  SET_IS_TWO_FACTOR,
  SET_USER,
  SET_PAGE_TITLE,
  SET_PAGE_IS_LOADING
} from './mutation-types.js'

Vue.use(Vuex)

const AUTH_TOKEN_KEY = 'authToken'
const PAGE_TITLE_PATTERN = 'Realty | {title}'
const PAGE_LOADING_TIMEOUT = 2000

export default new Vuex.Store({
  state: {
    authToken: window.localStorage.getItem(AUTH_TOKEN_KEY),
    isTwoFactor: false,
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

    [SET_IS_TWO_FACTOR] (state, isTwoFactor) {
      state.isTwoFactor = isTwoFactor
    },

    [SET_USER] (state, user) {
      state.user = user
    },

    [SET_PAGE_TITLE] (state, title) {
      state.pageTitle = PAGE_TITLE_PATTERN.replace('{title}', title)

      Vue.nextTick(() => {
        document.title = state.pageTitle
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
    login ({ commit }, data) {
      return new Promise((resolve, reject) => {
        axios.post('/auth/token', data)
          .then(res => {
            if (res.data['2fa']) {
              commit(SET_IS_TWO_FACTOR, true)
            } else {
              const token = res.data.access_token
              commit(SET_IS_TWO_FACTOR, false)
              commit(SET_AUTH_TOKEN, token)
              window.localStorage.setItem(AUTH_TOKEN_KEY, token)
            }

            return resolve(res)
          })
          .catch(error => {
            return reject(error)
          })
      })
    },

    logout ({ commit }) {
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

    fetchUser ({ commit }) {
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
