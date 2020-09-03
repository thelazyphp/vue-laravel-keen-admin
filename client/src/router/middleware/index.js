import user  from './user.js'
import auth  from './auth.js'
import guest from './guest.js'

export default {
  global: [
    user,
  ],

  route: {
    auth,
    guest,
  }
}
