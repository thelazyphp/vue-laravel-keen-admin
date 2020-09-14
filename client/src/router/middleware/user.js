export default function user ({ next, store }) {
  if (store.getters['auth/isAuthenticated'] && !store.state.user) {
    return store.dispatch('fetchUser')
      .then(() => next())
  }

  return next()
}
