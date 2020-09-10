export default [
  {
    path: '/',
    component: () => import('@/layouts/Default.vue'),

    children: [
      {
        path: '',

        meta: {
          middleware: ['auth'],
          title: 'Главная'
        },

        component: () => import('@/views/Home.vue')
      },
      {
        path: 'profile',

        meta: {
          middleware: ['auth'],
          title: 'Профиль',
          subheader: 'the-edit-profile-subheader'
        },

        component: () => import('@/views/Profile.vue')
      }
    ]
  },
  {
    path: '/',
    component: () => import('@/layouts/Empty.vue'),

    children: [
      {
        path: 'sign-in',

        meta: {
          middleware: ['guest'],
          title: 'Войти в аккаунт'
        },

        component: () => import('@/views/SignIn.vue')
      },
      {
        path: 'sign-up',

        meta: {
          middleware: ['guest'],
          title: 'Создать аккаунт'
        },

        component: () => import('@/views/SignUp.vue')
      }
    ]
  }
]
