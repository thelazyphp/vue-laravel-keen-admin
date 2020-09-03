import ApiService from '@/services/api.service.js'

export default {
  namespaced: true,

  state: {
    filters: {
      transaction: 'sell',
      category: 'apartments',
      type: [],
      source: [],
      seller_type: null,
      rooms: [],

      floor: {
        min: null,
        max: null
      },

      floors: {
        min: null,
        max: null
      },

      year_built: {
        min: null,
        max: null
      },

      roof: [],
      walls: [],
      balcony: [],
      bathroom: [],

      size_land: {
        min: null,
        max: null
      },

      size_total: {
        min: null,
        max: null
      },

      size_living: {
        min: null,
        max: null
      },

      size_kitchen: {
        min: null,
        max: null
      },

      price_amount: {
        min: null,
        max: null
      },

      price_sq_m_amount: {
        min: null,
        max: null
      },

      published_at: {
        min: null,
        max: null
      }
    },

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

      params.append(
        'transaction', state.filters.transaction
      )

      params.append(
        'category', state.filters.category
      )

      if (state.filters.type.length) {
        params.append(
          'type', `in:${state.filters.type.join(',')}`
        )
      }

      if (state.filters.source.length) {
        params.append(
          'source', `in:${state.filters.source.join(',')}`
        )
      }

      if (!!state.filters.seller_type) {
        params.append(
          'seller_type', state.filters.seller_type
        )
      }

      if (state.filters.rooms.length) {
        params.append(
          'rooms', `in:${state.filters.rooms.join(',')}`
        )
      }

      if (!!state.filters.floor.min) {
        params.append(
          'floor', `ge:${state.filters.floor.min}`
        )
      }

      if (!!state.filters.floor.max) {
        params.append(
          'floor', `le:${state.filters.floor.max}`
        )
      }

      if (!!state.filters.floors.min) {
        params.append(
          'floors', `ge:${state.filters.floors.min}`
        )
      }

      if (!!state.filters.floors.max) {
        params.append(
          'floors', `le:${state.filters.floors.max}`
        )
      }

      if (!!state.filters.year_built.min) {
        params.append(
          'year_built', `ge:${state.filters.year_built.min}`
        )
      }

      if (!!state.filters.year_built.max) {
        params.append(
          'year_built', `le:${state.filters.year_built.max}`
        )
      }

      if (state.filters.roof.length) {
        params.append(
          'roof', `in:${state.filters.roof.join(',')}`
        )
      }

      if (state.filters.walls.length) {
        params.append(
          'walls', `in:${state.filters.walls.join(',')}`
        )
      }

      if (state.filters.balcony.length) {
        params.append(
          'balcony', `in:${state.filters.balcony.join(',')}`
        )
      }

      if (state.filters.bathroom.length) {
        params.append(
          'bathroom', `in:${state.filters.bathroom.join(',')}`
        )
      }

      if (!!state.filters.size_land.min) {
        params.append(
          'size_land', `ge:${state.filters.size_land.min}`
        )
      }

      if (!!state.filters.size_land.max) {
        params.append(
          'size_land', `le:${state.filters.size_land.max}`
        )
      }

      if (!!state.filters.size_total.min) {
        params.append(
          'size_total', `ge:${state.filters.size_total.min}`
        )
      }

      if (!!state.filters.size_total.max) {
        params.append(
          'size_total', `le:${state.filters.size_total.max}`
        )
      }

      if (!!state.filters.size_living.min) {
        params.append(
          'size_living', `ge:${state.filters.size_living.min}`
        )
      }

      if (!!state.filters.size_living.max) {
        params.append(
          'size_living', `le:${state.filters.size_living.max}`
        )
      }

      if (!!state.filters.size_kitchen.min) {
        params.append(
          'size_kitchen', `ge:${state.filters.size_kitchen.min}`
        )
      }

      if (!!state.filters.size_kitchen.max) {
        params.append(
          'size_kitchen', `le:${state.filters.size_kitchen.max}`
        )
      }

      if (!!state.filters.price_amount.min) {
        params.append(
          'price_amount', `ge:${state.filters.price_amount.min}`
        )
      }

      if (!!state.filters.price_amount.max) {
        params.append(
          'price_amount', `le:${state.filters.price_amount.max}`
        )
      }

      if (!!state.filters.price_sq_m_amount.min) {
        params.append(
          'price_sq_m_amount', `ge:${state.filters.price_sq_m_amount.min}`
        )
      }

      if (!!state.filters.price_sq_m_amount.max) {
        params.append(
          'price_sq_m_amount', `le:${state.filters.price_sq_m_amount.max}`
        )
      }

      if (!!state.filters.published_at.min) {
        params.append(
          'published_at', `ge:${state.filters.published_at.min}`
        )
      }

      if (!!state.filters.published_at.max) {
        params.append(
          'published_at', `le:${state.filters.published_at.max}`
        )
      }

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
    setFilters (state, filters) {
      state.filters = filters
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

    setLimit (state, limit) {
      state.limit = limit
    },

    setItems (state, items) {
      state.items = items
    },

    setLastPage (state, page) {
      state.lastPage = page
    },

    resetFilters (state) {
      state.filters.transaction = 'sell'
      state.filters.category = 'apartments'
      state.filters.type = []
      state.filters.source = []
      state.filters.seller_type = null
      state.filters.rooms = []
      state.filters.floor.min = null
      state.filters.floor.max = null
      state.filters.floors.min = null
      state.filters.floors.max = null
      state.filters.year_built.min = null
      state.filters.year_built.max = null
      state.filters.roof = []
      state.filters.walls = []
      state.filters.balcony = []
      state.filters.bathroom = []
      state.filters.size_land.min = null
      state.filters.size_land.max = null
      state.filters.size_total.min = null
      state.filters.size_total.max = null
      state.filters.size_living.min = null
      state.filters.size_living.max = null
      state.filters.size_kitchen.min = null
      state.filters.size_kitchen.max = null
      state.filters.price_amount.min = null
      state.filters.price_amount.max = null
      state.filters.price_sq_m_amount.min = null
      state.filters.price_sq_m_amount.max = null
      state.filters.published_at.min = null
      state.filters.published_at.max = null
    }
  },

  actions: {
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
        const res = await ApiService.getAds(getters.searchParams)
        commit('setItems', res.data.data)
        commit('setLastPage', res.data.meta.last_page)
      } catch (error) {
        //
      }
    }
  }
}
