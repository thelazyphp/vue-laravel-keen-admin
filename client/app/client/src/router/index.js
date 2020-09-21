import Vue from 'vue'
import VueRouter from 'vue-router'
import Login from '../views/Login.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/login',
    name: 'login',
    component: Login
  },
  {
    path: '/404',
    name: 'error',
    component: () => import(/* webpackChunkName: "error" */ '../views/Error.vue')
  },
  {
    path: '/',
    component: () => import('../views/Layout.vue'),
    children: [
      {
        path: '',
        name: 'home',
        component: () => import(/* webpackChunkName: "home" */ '../views/Home.vue')
      },
      {
        path: 'clients',
        name: 'clients',
        component: () => import(/* webpackChunkName: "clients" */ '../views/Clients.vue')
      },
      {
        path: 'employees',
        name: 'employees',
        component: () => import(/* webpackChunkName: "employees" */ '../views/Employees.vue')
      }
    ]
  },
  {
    path: '*',
    redirect: { name: 'error' }
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
