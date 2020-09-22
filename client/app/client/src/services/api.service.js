import axios from "axios"

const ApiService = {
  init () {
    axios.defaults.baseURL = process.env.BASE_URL + "api"
  },
  /**
   * @param {string} name
   * @param {string} value
   */
  setHeader (name, value) {
    axios.defaults.headers.common[name] = value
  },
  /**
   * @param {string} name
   */
  removeHeader (name) {
    delete axios.defaults.headers.common[name]
  },
  /**
   * @param {string} resource
   * @param {object} [params={}]
   * @return {Promise}
   */
  query (resource, params = {}) {
    return axios.get(resource, { params })
  },
  /**
   * @param {string} resource
   * @param {(string|number)} [slug=""]
   * @return {Promise}
   */
  get (resource, slug = "") {
    return axios.get(resource + (slug ? "/" + slug : ""))
  },
  /**
   * @param {string} resource
   * @param {(string|number)} [slug=""]
   * @param {object=} [data]
   * @return {Promise}
   */
  post (resource, slug = "", data = null) {
    return axios.post(
      resource + (slug ? "/" + slug : ""), data
    )
  },
  /**
   * @param {string} resource
   * @param {(string|number)} [slug=""]
   * @param {object=} [data]
   * @return {Promise}
   */
  put (resource, slug = "", data = null) {
    return axios.put(
      resource + (slug ? "/" + slug : ""), data
    )
  },
  /**
   * @param {string} resource
   * @param {(string|number)} [slug=""]
   * @param {object=} [data]
   * @return {Promise}
   */
  patch (resource, slug = "", data = null) {
    return axios.patch(
      resource + (slug ? "/" + slug : ""), data
    )
  },
  /**
   * @param {string} resource
   * @param {(string|number)} [slug=""]
   * @return {Promise}
   */
  delete (resource, slug = "") {
    return axios.delete(resource + (slug ? "/" + slug : ""))
  }
}

export default ApiService
