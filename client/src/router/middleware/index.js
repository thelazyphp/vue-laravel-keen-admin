import user from './user.js'
import title from './title.js'
import auth from './auth.js'
import guest from './guest.js'

export default {
  global: [
    user,
    title,
  ],

  route: {
    auth,
    guest,
  }
}
