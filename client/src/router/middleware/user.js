import store from '@/store'

export default function (to, from, next) {
  if (store.getters['auth/isAuthenticated'] && !store.state.user) {
    store.dispatch('fetchUser')
      .then(() => next())
  } else {
    next()
  }
}
