import Vue from "vue"
import VueRouter from "vue-router"
import Login from "../views/Login.vue"
import auth from "./middleware/auth.middleware.js"
import guest from "./middleware/guest.middleware.js"
import {
  FETCH_USER
} from "../store"
import store from "../store"

Vue.use(VueRouter)

const routes = [
  {
    path: "/login",
    name: "login",
    component: Login,
    meta: {
      middleware: [
        guest
      ]
    }
  },
  {
    path: "/404",
    name: "error",
    component: () => import(/* webpackChunkName: "error" */ "../views/Error.vue")
  },
  {
    path: "/",
    component: () => import("../views/Layout.vue"),
    redirect: "/dashboard",
    children: [
      {
        path: "dashboard",
        name: "dashboard",
        component: () => import(/* webpackChunkName: "dashboard" */ "../views/Dashboard.vue"),
        meta: {
          middleware: [
            auth
          ]
        }
      },
      {
        path: "profile",
        name: "profile",
        component: () => import(/* webpackChunkName: "profile" */ "../views/Profile.vue"),
        meta: {
          middleware: [
            auth
          ]
        }
      },
      {
        path: "ads",
        name: "ads",
        component: () => import(/* webpackChunkName: "ads" */ "../views/Ads.vue"),
        meta: {
          middleware: [
            auth
          ]
        }
      },
      {
        path: "bookmarks",
        name: "bookmarks",
        component: () => import(/* webpackChunkName: "bookmarks" */ "../views/Bookmarks.vue"),
        meta: {
          middleware: [
            auth
          ]
        }
      },
      {
        path: "requests",
        name: "requests",
        component: () => import(/* webpackChunkName: "requests" */ "../views/Requests.vue"),
        meta: {
          middleware: [
            auth
          ]
        }
      },
      {
        path: "clients",
        name: "clients",
        component: () => import(/* webpackChunkName: "clients" */ "../views/Clients.vue"),
        meta: {
          middleware: [
            auth
          ]
        }
      },
      {
        path: "employees",
        name: "employees",
        component: () => import(/* webpackChunkName: "employees" */ "../views/Employees.vue"),
        meta: {
          middleware: [
            auth
          ]
        }
      }
    ]
  },
  {
    path: "*",
    redirect: "/404"
  }
]

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes
})

router.beforeEach(async (to, from, next) => {
  if (to.meta.middleware) {
    const context = {
      to,
      from,
      next,
      store
    }

    for (let middleware of to.meta.middleware) {
      await middleware({ ...context })
    }
  }

  next()
})

router.beforeEach((to, from, next) => {
  if (store.getters["auth/isAuthenticated"] && !store.getters.user) {
    store.dispatch(FETCH_USER).then(next)
  } else {
    next()
  }
})

export default router
