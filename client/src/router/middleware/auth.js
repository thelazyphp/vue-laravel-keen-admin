export default function auth ({ next, store }) {
  if (store.getters['auth/isAuthenticated']) {
    return next()
  }

  return next({ name: 'sign-in' })
}
