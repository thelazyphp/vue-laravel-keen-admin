import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const SET_PAGE_TITLE = 'setPageTitle'

export default new Vuex.Store({
  state: {
    pageTitle: ''
  },
  getters: {
    pageTitle (state) {
      return state.pageTitle
    }
  },
  mutations: {
    [SET_PAGE_TITLE](state, title) {
      state.pageTitle = title
      document.title = title
    }
  }
})
