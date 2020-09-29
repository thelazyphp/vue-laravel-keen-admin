export const SET_FILTERS = "setFilters"
export const RESET_FILTERS = "resetFilters"

export default {
  namespaced: true,
  state: {
    filters: {
      transaction: "sell",
      sellerType: null,
      source: [],
      rooms: [],
      floor: {
        min: null,
        max: null
      },
      floors: {
        min: null,
        max: null
      },
      yearBuilt: {
        min: null,
        max: null
      },
      sizeTotal: {
        min: null,
        max: null
      },
      sizeLiving: {
        min: null,
        max: null
      },
      sizeKitchen: {
        min: null,
        max: null
      },
      priceAmount: {
        min: null,
        max: null
      },
      priceSqMAmount: {
        min: null,
        max: null
      }
    }
  },
  getters: {
    datatableParams (state) {
      let params = {}

      if (state.filters.transaction) {
        params["transaction:eq"] = state.filters.transaction
      }

      if (state.filters.sellerType) {
        params["seller.type:eq"] = state.filters.sellerType
      }

      if (state.filters.source.length) {
        params["source:in"] = state.filters.source.join(",")
      }

      if (state.filters.rooms.length) {
        params["rooms:in"] = state.filters.rooms.join(",")
      }

      if (state.filters.floor.min) {
        params["floor:ge"] = state.filters.floor.min
      }

      if (state.filters.floor.max) {
        params["floor:le"] = state.filters.floor.max
      }

      if (state.filters.floors.min) {
        params["floors:ge"] = state.filters.floors.min
      }

      if (state.filters.floors.max) {
        params["floors:le"] = state.filters.floors.max
      }

      if (state.filters.yearBuilt.min) {
        params["year_built:ge"] = state.filters.yearBuilt.min
      }

      if (state.filters.yearBuilt.max) {
        params["year_built:le"] = state.filters.yearBuilt.max
      }

      if (state.filters.sizeTotal.min) {
        params["size_total:ge"] = state.filters.sizeTotal.min
      }

      if (state.filters.sizeTotal.max) {
        params["size_total:le"] = state.filters.sizeTotal.max
      }

      if (state.filters.sizeLiving.min) {
        params["size_living:ge"] = state.filters.sizeLiving.min
      }

      if (state.filters.sizeLiving.max) {
        params["size_living:le"] = state.filters.sizeLiving.max
      }

      if (state.filters.sizeKitchen.min) {
        params["size_kitchen:ge"] = state.filters.sizeKitchen.min
      }

      if (state.filters.sizeKitchen.max) {
        params["size_kitchen:le"] = state.filters.sizeKitchen.max
      }

      if (state.filters.priceAmount.min) {
        params["price_amount:ge"] = state.filters.priceAmount.min
      }

      if (state.filters.priceAmount.max) {
        params["price_amount:le"] = state.filters.priceAmount.max
      }

      if (state.filters.priceSqMAmount.min) {
        params["price_sq_m_amount:ge"] = state.filters.priceSqMAmount.min
      }

      if (state.filters.priceSqMAmount.max) {
        params["price_sq_m_amount:le"] = state.filters.priceSqMAmount.max
      }

      return params
    },
    filters (state) {
      return state.filters
    }
  },
  mutations: {
    [SET_FILTERS] (state, filters) {
      state.filters = filters
    },
    [RESET_FILTERS] (state) {
      state.filters.transaction = "sell"
      state.filters.sellerType = null
      state.filters.source = []
      state.filters.rooms = []
      state.filters.floor.min = null
      state.filters.floor.max = null
      state.filters.floors.min = null
      state.filters.floors.max = null
      state.filters.yearBuilt.min = null
      state.filters.yearBuilt.max = null
      state.filters.sizeTotal.min = null
      state.filters.sizeTotal.max = null
      state.filters.sizeLiving.min = null
      state.filters.sizeLiving.max = null
      state.filters.sizeKitchen.min = null
      state.filters.sizeKitchen.max = null
      state.filters.priceAmount.min = null
      state.filters.priceAmount.max = null
      state.filters.priceSqMAmount.min = null
      state.filters.priceSqMAmount.max = null
    }
  }
}
