import ApiService from '@/services/api.service.js'

const findIndexById = (items, id) => items.findIndex(item => item.id == id)

export default {
  namespaced: true,

  state: {
    current: null,
    query: null,
    sort: null,
    page: 1,
    limit: 15,
    items: [],
    lastPage: null
  },

  getters: {
    searchParams (state) {
      let params = new URLSearchParams()

      if (!!state.query) {
        params.append(
          'q', state.query
        )
      }

      if (!!state.sort) {
        params.append(
          'sort', state.sort
        )
      }

      params.append(
        'page', state.page
      )

      params.append(
        'limit', state.limit
      )

      return params
    }
  },

  mutations: {
    setCurrent (state, user) {
      state.current = user
    },

    setQuery (state, query) {
      state.query = query
    },

    setSort (state, sort) {
      state.sort = sort
    },

    setPage (state, page) {
      state.page = page
    },

    incrementPage (state) {
      state.page++
    },

    decrementPage (state) {
      state.page--
    },

    seLimit (state, limit) {
      state.limit = limit
    },

    setItems (state, items) {
      state.items = items
    },

    setLastPage (state, page) {
      state.lastPage = page
    },

    removeItem (state, id) {
      const index = findIndexById(state.items, id)
      state.items.splice(index, 1)
    }
  },

  actions: {
    async fetchCurrent ({ commit }) {
      try {
        const res = await ApiService.getCurrentUser()
        commit('setCurrent', res.data.data)
      } catch (error) {
        //
      }
    },

    async removeCurrent ({ commit }) {
      try {
        await ApiService.removeCurrentUser()
        commit('setCurrent', null)
      } catch (error) {
        //
      }
    },

    async updateCurrent ({ commit }, user) {
      try {
        const res = await ApiService.updateCurrentUser(user)
        commit('setCurrent', res.data.data)
      } catch (error) {
        //
      }
    },

    async remove ({ commit }, id) {
      try {
        await ApiService.removeUser(id)
        commit('removeItem', id)
      } catch (error) {
        //
      }
    },

    async fetchPrev ({ commit, dispatch }) {
      commit('decrementPage')
      await dispatch('fetch')
    },

    async fetchNext ({ commit, dispatch }) {
      commit('incrementPage')
      await dispatch('fetch')
    },

    async fetch ({ getters, commit }) {
      try {
        const res = await ApiService.getUsers(getters.searchParams)
        commit('setItems', res.data.data)
        commit('setLastPage', res.data.meta.last_page)
      } catch (error) {
        //
      }
    }
  }
}
