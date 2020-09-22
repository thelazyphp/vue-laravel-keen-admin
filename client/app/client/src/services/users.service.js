import ApiService from "./api.service.js"

const UsersService = {
  /**
   * @param {number} id
   * @return {Promise}
   */
  get (id) {
    return ApiService.get("/users", id)
  },
  /**
   * @return {Promise}
   */
  getSelf () {
    return ApiService.get("/users", "self")
  },
  /**
   * @param {object} data
   * @return {Promise}
   */
  register (data) {
    return ApiService.post("/users/register", "", data)
  }
}

export default UsersService
