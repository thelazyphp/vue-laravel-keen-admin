export default {
  namespaced: true,

  state: {
    filters: {
      role: []
    }
  },

  getters: {
    /**
     * @returns {object}
     */
    filters (state) {
      return state.filters
    },

    /**
     * @returns {object}
     */
    datatableParams (state) {
      let params = {}

      if (state.filters.role.length) {
        params["role:in"] = state.filters.role.join(",")
      }

      return params
    }
  },

  mutations: {
    /**
     * Stores filters.
     *
     * @param {object} filters
     */
    setFilters (state, filters) {
      state.filters = filters
    },

    /**
     * Resets filters to the initial state.
     */
    resetFilters (state) {
      state.filters.role = []
    }
  }
}
