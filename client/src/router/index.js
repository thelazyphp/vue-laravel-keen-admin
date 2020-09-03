import Vue        from 'vue'
import VueRouter  from 'vue-router'
import routes     from './routes'
import middleware from './middleware'
import store      from '@/store'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.title) {
    document.title = to.meta.title
  }

  middleware.global.forEach(item => {
    item(to, from, next, store)
  })

  if (to.meta.middleware) {
    to.meta.middleware.forEach(item => {
      middleware.route[item](to, from, next, store)
    })
  }

  next()
})

export default router
