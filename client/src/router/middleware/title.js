export default async function (to, from, next, store) {
  if (to.meta.title) {
    document.title = `${to.meta.title} | Realty`
  }

  next()
}
