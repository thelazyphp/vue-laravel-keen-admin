export default function (to, from, next, store) {
  if (store.getters['auth/check']) {
    next('/')
  } else {
    next()
  }
}
