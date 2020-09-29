export default function ({ store, next }) {
  if (!store.getters["auth/isAuthenticated"]) {
    next({
      name: "login"
    })
  }
}
