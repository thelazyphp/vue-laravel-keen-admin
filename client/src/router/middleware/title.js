export default function title ({ to, next }) {
  if (to.meta.title) {
    document.title = `${to.meta.title} | Realty`
  }

  return next()
}
