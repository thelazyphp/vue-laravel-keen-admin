import axios from "axios"

const ApiService = {
  /**
   * Inits the API service.
   */
  init () {
    axios.defaults.baseURL = process.env.BASE_URL + "api"

    axios.defaults.params = {
      lang: "ru"
    }
  },

  /**
   * Sets the HTTP header.
   *
   * @param {string} name
   * @param {string} value
   */
  setHeader (name, value) {
    axios.defaults.headers.common[name] = value
  },

  /**
   * Removes the HTTP header.
   *
   * @param {string} name
   */
  removeHeader (name) {
    delete axios.defaults.headers.common[name]
  },

  /**
   * Queries the API resource.
   *
   * @param {string} resource
   * @param {object} [params={}]
   * @return {Promise}
   */
  query (resource, params = {}) {
    return axios.get(resource, { params })
  },

  /**
   * Retrives the API resource.
   *
   * @param {string} resource
   * @param {string} [slug=""]
   * @return {Promise}
   */
  get (resource, slug = "") {
    return axios.get(resource + (slug ? "/" + slug : ""))
  },

  /**
   * Creates the API resource.
   *
   * @param {string} resource
   * @param {string} [slug=""]
   * @param {object?} [data]
   * @return {Promise}
   */
  post (resource, slug = "", data = null) {
    return axios.post(
      resource + (slug ? "/" + slug : ""), data
    )
  },

  /**
   * Replaces the API resource.
   *
   * @param {string} resource
   * @param {string} [slug=""]
   * @param {object?} [data]
   * @return {Promise}
   */
  put (resource, slug = "", data = null) {
    return axios.put(
      resource + (slug ? "/" + slug : ""), data
    )
  },

  /**
   * Updates the API resource.
   *
   * @param {string} resource
   * @param {string} [slug=""]
   * @param {object?} [data]
   * @return {Promise}
   */
  patch (resource, slug = "", data = null) {
    return axios.patch(
      resource + (slug ? "/" + slug : ""), data
    )
  },

  /**
   * Removes the API resource.
   *
   * @param {string} resource
   * @param {string} [slug=""]
   * @return {Promise}
   */
  delete (resource, slug = "") {
    return axios.delete(resource + (slug ? "/" + slug : ""))
  }
}

export default ApiService
