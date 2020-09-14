import Home from '@/views/Home.vue'
import auth from '../middleware/auth.js'
import guest from '../middleware/guest.js'
import user from '../middleware/user.js'
import title from '../middleware/title.js'

export default [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      title: 'Главная',
      layout: 'default',
      middleware: [
        auth,
        user,
        title,
      ]
    }
  },
  {
    path: '/sign-in',
    name: 'sign-in',
    component: () => import('@/views/SignIn.vue'),
    meta: {
      title: 'Войти в аккаунт',
      layout: 'empty',
      middleware: [
        guest,
        title,
      ]
    }
  },
  {
    path: '/sign-up',
    name: 'sign-up',
    component: () => import('@/views/SignUp.vue'),
    meta: {
      title: 'Создать аккаунт',
      layout: 'empty',
      middleware: [
        guest,
        title,
      ]
    }
  },
  {
    path: '/ads',
    component: () => import('@/views/Ads'),
    meta: {
      layout: 'default'
    },
    children: [
      {
        path: 'apartments',
        name: 'ads.apartments',
        component: () => import('@/views/Ads/Apartments.vue'),
        meta: {
          title: 'Квартиры',
          middleware: [
            auth,
            title,
          ]
        }
      },
      {
        path: 'houses',
        name: 'ads.houses',
        component: () => import('@/views/Ads/Houses.vue'),
        meta: {
          title: 'Земельная',
          middleware: [
            auth,
            title,
          ]
        }
      },
      {
        path: 'commercial-real-estate',
        name: 'ads.commercial-real-estate',
        component: () => import('@/views/Ads/CommercialRealEstate.vue'),
        meta: {
          title: 'Коммерческая',
          middleware: [
            auth,
            title,
          ]
        }
      }
    ]
  },
  {
    path: '/user',
    component: () => import('@/views/User'),
    meta: {
      layout: 'default'
    },
    children: [
      {
        path: 'profile',
        name: 'user.profile',
        component: () => import('@/views/User/Profile.vue'),
        meta: {
          title: 'Профиль',
          middleware: [
            auth,
            user,
            title,
          ]
        }
      },
      {
        path: 'account',
        name: 'user.account',
        component: () => import('@/views/User/Account.vue'),
        meta: {
          title: 'Аккаунт',
          middleware: [
            auth,
            user,
            title,
          ]
        }
      },
      {
        path: 'company',
        name: 'user.company',
        component: () => import('@/views/User/Company.vue'),
        meta: {
          title: 'Организация',
          middleware: [
            auth,
            user,
            title,
          ]
        }
      }
    ]
  }
]
