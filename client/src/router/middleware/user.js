export default async function (to, from, next, store) {
  if (store.getters['auth/check'] && !store.state.users.current) {
    await store.dispatch('users/fetchCurrent')
  }

  next()
}
