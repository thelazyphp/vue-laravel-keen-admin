import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../views/Login.vue'
import store from '../store'

Vue.use(VueRouter)

const routes = [
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: {
      requiresGuest: true
    }
  },
  {
    path: '/',
    component: () => import('../components/layout'),
    children: [
      {
        path: '',
        name: 'Home',
        component: () => import(/* webpackChunkName: "home" */ '../views/Home.vue'),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: 'nca',
        name: 'Nca',
        component: () => import(/* webpackChunkName: "nca" */ '../views/Nca.vue'),
        meta: {
          requiresAuth: true
        }
      },
      {
        path: 'profile',
        name: 'Profile',
        component: () => import(/* webpackChunkName: "profile" */ '../views/Profile.vue'),
        meta: {
          requiresAuth: true
        }
      }
    ]
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !store.state.auth.isAuthenticated) {
    next({
      name: 'Login'
    })
  } else if (to.meta.requiresGuest && store.state.auth.isAuthenticated) {
    next({
      name: 'Home'
    })
  } else {
    next()
  }
})

router.beforeEach((to, from, next) => {
  if (store.state.auth.isAuthenticated && !store.state.user) {
    store.dispatch('fetchUser').then(next)
  } else {
    next()
  }
})

export default router
