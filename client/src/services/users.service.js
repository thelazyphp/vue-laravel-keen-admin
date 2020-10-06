import ApiService from "./api.service.js"

const UsersService = {
  /**
   * Registers a new user.
   *
   * @param {object} data
   * @return {Promise}
   */
  register (data) {
    return ApiService.post("/users/register", "", data)
  },

  /**
   * Retrives the user.
   *
   * @param {string} slug
   * @return {Promise}
   */
  get (slug) {
    return ApiService.get("/users", slug)
  },

  /**
   * Uploads the user image.
   *
   * @param {File} file
   * @return {Promise}
   */
  uploadImage (file) {
    const data = new FormData()
    data.append('file', file)
    return ApiService.post("/images", "", data)
  },

  /**
   * Updates the user profile.
   *
   * @param {string} slug
   * @param {object} data
   * @return {Promise}
   */
  updateProfile (slug, data) {
    return ApiService.patch("/users", slug + "/profile", data)
  },

  /**
   * Updates the user account.
   *
   * @param {string} slug
   * @param {object} data
   * @return {Promise}
   */
  updateAccount (slug, data) {
    return ApiService.patch("/users", slug + "/account", data)
  },

  /**
   * Updates the user company.
   *
   * @param {string} slug
   * @param {object} data
   * @return {Promise}
   */
  updateCompany (slug, data) {
    return ApiService.patch("/users", slug + "/company", data)
  }
}

export default UsersService
