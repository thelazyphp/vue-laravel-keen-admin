import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../views/Login.vue'
import store from '../store'
import { FETCH_USER, SET_PAGE_TITLE } from '../store'

Vue.use(VueRouter)

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      pageTitle: 'Войти в аккаунт'
    }
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    if (!store.getters.isAuthenticated) {
      next({
        name: 'Login'
      })
    }
  }

  next()
})

router.beforeEach((to, from, next) => {
  if (store.getters.isAuthenticated) {
    if (!store.state.user) {
      store.dispatch(FETCH_USER).then(next)
    }
  }

  next()
})

router.beforeEach((to, from, next) => {
  if (to.meta.pageTitle) {
    store.commit(SET_PAGE_TITLE, to.meta.pageTitle)
  }

  next()
})

export default router
