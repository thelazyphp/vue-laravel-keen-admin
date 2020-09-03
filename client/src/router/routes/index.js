import Home from '@/views/Home.vue'

export default [
  {
    path: '/',
    component: Home,

    meta: {
      title: 'Главная | Realty',
      layout: 'default',
      middleware: ['auth']
    }
  },
  {
    path: '/sign-in',

    meta: {
      title: 'Войти в аккаунт | Realty',
      layout: 'empty',
      middleware: ['guest']
    },

    component: () => import(/* webpackChunkName: "sign-in" */ '@/views/SignIn.vue')
  },
  {
    path: '/sign-up',

    meta: {
      title: 'Создать аккаунт | Realty',
      layout: 'empty',
      middleware: ['guest']
    },

    component: () => import(/* webpackChunkName: "sign-up" */ '@/views/SignUp.vue')
  },
]
