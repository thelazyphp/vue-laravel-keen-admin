import Vue from 'vue'
import routes from './routes'
import VueRouter from 'vue-router'
import middleware from './middleware'

Vue.use(VueRouter)

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  middleware.global.forEach(item => {
    item(to, from, next)
  })

  if (to.meta.middleware) {
    to.meta.middleware.forEach(item => {
      middleware.route[item](to, from, next)
    })
  }

  next()
})

export default router
