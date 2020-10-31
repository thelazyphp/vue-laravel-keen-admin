import axios from 'axios'

const Users = {
  /**
   * Registers a new user.
   *
   * @param {object} data - The user data
   * @returns {Promise}
   */
  register (data) {
    return axios.post('/users/register', data)
  },

  /**
   * Retrieves the authenticated user.
   *
   * @returns {Promise}
   */
  getSelf () {
    return axios.get('/users/self')
  },

  /**
   * Updates the authenticated user account.
   *
   * @param {object} data - The account data
   * @returns {Promise}
   */
  updateSelfAccount (data) {
    return axios.put('/users/self/account', data)
  },

  /**
   * Updates the authenticated user profile.
   *
   * @param {object} data - The profile data
   * @returns {Promise}
   */
  updateSelfProfile (data) {
    return axios.put('/users/self/profile', data)
  },

  /**
   * Updates the authenticated user password.
   *
   * @param {object} data - The password data
   * @returns {Promise}
   */
  updateSelfPassword (data) {
    return axios.put('/users/self/password', data)
  }
}

export default Users
