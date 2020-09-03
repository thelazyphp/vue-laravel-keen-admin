import Home from '@/views/Home.vue'

export default [
  {
    path: '/',
    name: 'home',
    component: Home,

    meta: {
      title: 'Главная',
      layout: 'default',
      middleware: ['auth']
    }
  },
  {
    path: '/sign-in',
    name: 'sign-in',

    meta: {
      title: 'Войти в аккаунт',
      layout: 'empty',
      middleware: ['guest']
    },

    component: () => import(/* webpackChunkName: "sign-in" */ '@/views/SignIn.vue')
  },
  {
    path: '/sign-up',
    name: 'sign-up',

    meta: {
      title: 'Создать аккаунт',
      layout: 'empty',
      middleware: ['guest']
    },

    component: () => import(/* webpackChunkName: "sign-up" */ '@/views/SignUp.vue')
  },
]
