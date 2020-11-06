<template>
  <div class="d-flex flex-column flex-root">
    <div
      id="kt_login"
      class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
    >
      <div
        class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat p-10 p-lg-10"
        :style="{ backgroundImage: `url(${backgroundImage})` }"
      >
        <div class="d-flex flex-row-fluid flex-column justify-content-between">
          <router-link
            to="/"
            class="flex-column-auto mt-5 pb-lg-0 pb-10"
          >
            <img
              src="@/assets/media/logos/logo-letter-1.png"
              alt=""
              class="max-h-70px"
            >
          </router-link>
          <div class="flex-column-fluid d-flex flex-column justify-content-center">
            <h3 class="font-size-h1 mb-5 text-white">
              Добро пожаловать в {{ appName }}!
            </h3>
            <p class="font-weight-lighter text-white opacity-80">
              Парсер объявлений об аренде и продаже недвижимости.
            </p>
          </div>
          <div class="d-none flex-column-auto d-lg-flex justify-content-between mt-10">
            <div class="opacity-70 font-weight-bold	text-white">
              &copy; {{ year }} {{ appName }}
            </div>
            <div class="d-flex">
              <a
                href=""
                class="text-white"
              >
                Помощь
              </a>
              <a
                href=""
                class="text-white ml-10"
              >
                Разработчикам
              </a>
              <a
                href=""
                class="text-white ml-10"
              >
                Связаться с нами
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex flex-column flex-row-fluid position-relative p-7 overflow-hidden">
        <div class="position-absolute top-0 right-0 text-right mt-5 mb-15 mb-lg-0 flex-column-auto justify-content-center py-5 px-10">
          <span class="font-weight-bold text-dark-50">
            Еще нет аккаунта?
          </span>
          <a
            id="kt_login_signup"
            href=""
            class="font-weight-bold ml-2"
            @click.prevent="showForm('signup')"
          >
            Создать аккаунт!
          </a>
        </div>
        <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
          <div class="login-form login-signin">
            <div class="text-center mb-10 mb-lg-20">
              <h3 class="font-size-h1">
                Войти
              </h3>
              <p class="text-muted font-weight-bold">
                Введите email и пароль, чтобы войти
              </p>
            </div>
            <form
              id="kt_login_signin_form"
              class="form"
              novalidate
              @submit.prevent="submitSignInForm"
            >
              <div class="form-group">
                <input
                  id="signInFormEmail"
                  v-model="forms.signIn.data.email"
                  type="email"
                  class="form-control form-control-solid h-auto py-5 px-6"
                  :class="{ 'is-invalid': forms.signIn.errors.email }"
                  placeholder="Email"
                >
                <div
                  v-if="forms.signIn.errors.email"
                  class="invalid-feedback"
                >
                  {{ forms.signIn.errors.email[0] }}
                </div>
              </div>
              <div class="form-group">
                <input
                  v-model="forms.signIn.data.password"
                  type="password"
                  class="form-control form-control-solid h-auto py-5 px-6"
                  :class="{ 'is-invalid': forms.signIn.errors.password }"
                  placeholder="Пароль"
                >
                <div
                  v-if="forms.signIn.errors.password"
                  class="invalid-feedback"
                >
                  {{ forms.signIn.errors.password[0] }}
                </div>
              </div>
              <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                <a
                  id="kt_login_forgot"
                  href=""
                  class="text-dark-50 text-hover-primary my-3 mr-2"
                  @click.prevent="showForm('forgot')"
                >
                  Забыли пароль ?
                </a>
                <button
                  id="kt_login_signin_submit"
                  type="submit"
                  class="btn btn-primary font-weight-bold px-9 py-4 my-3"
                >
                  Войти
                </button>
              </div>
            </form>
          </div>
          <div class="login-form login-signup">
            <div class="text-center mb-10 mb-lg-20">
              <h3 class="font-size-h1">
                Создать аккаунт
              </h3>
              <p class="text-muted font-weight-bold">
                Заполните форму ниже, чтобы создать аккаунт
              </p>
            </div>
            <form
              id="kt_login_signup_form"
              class="form"
              novalidate
              @submit.prevent="submitSignUpForm"
            >
              <div class="form-group">
                <input
                  id="signUpFormName"
                  v-model="forms.signUp.data.name"
                  type="text"
                  class="form-control form-control-solid h-auto py-5 px-6"
                  :class="{ 'is-invalid': forms.signUp.errors.name }"
                  placeholder="Имя"
                >
                <div
                  v-if="forms.signUp.errors.name"
                  class="invalid-feedback"
                >
                  {{ forms.signUp.errors.name[0] }}
                </div>
              </div>
              <div class="form-group">
                <input
                  v-model="forms.signUp.data.email"
                  type="email"
                  class="form-control form-control-solid h-auto py-5 px-6"
                  :class="{ 'is-invalid': forms.signUp.errors.email }"
                  placeholder="Email"
                >
                <div
                  v-if="forms.signUp.errors.email"
                  class="invalid-feedback"
                >
                  {{ forms.signUp.errors.email[0] }}
                </div>
              </div>
              <div class="form-group">
                <input
                  v-model="forms.signUp.data.password"
                  type="password"
                  class="form-control form-control-solid h-auto py-5 px-6"
                  :class="{ 'is-invalid': forms.signUp.errors.password }"
                  placeholder="Пароль"
                >
                <div
                  v-if="forms.signUp.errors.password"
                  class="invalid-feedback"
                >
                  {{ forms.signUp.errors.password[0] }}
                </div>
              </div>
              <div class="form-group">
                <input
                  v-model="forms.signUp.data.password_confirmation"
                  type="password"
                  class="form-control form-control-solid h-auto py-5 px-6"
                  :class="{ 'is-invalid': forms.signUp.errors.password_confirmation }"
                  placeholder="Подтвердите пароль"
                  @paste.prevent
                >
                <div
                  v-if="forms.signUp.errors.password_confirmation"
                  class="invalid-feedback"
                >
                  {{ forms.signUp.errors.password_confirmation[0] }}
                </div>
              </div>
              <div class="form-group">
                <div class="checkbox-inline">
                  <label class="checkbox mb-0">
                    <input type="checkbox">
                    <span></span>
                    Я согласен с
                    <a
                      href=""
                      class="font-weight-bold ml-1"
                    >
                      условиями пользования
                    </a>
                    .
                  </label>
                </div>
              </div>
              <div class="form-group d-flex flex-wrap flex-center">
                <button
                  id="kt_login_signup_submit"
                  type="submit"
                  class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4"
                >
                  Создать аккаунт
                </button>
                <button
                  id="kt_login_signup_cancel"
                  type="button"
                  class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-4"
                  @click="showForm('signin')"
                >
                  Отмена
                </button>
              </div>
            </form>
          </div>
          <div class="login-form login-forgot">
            <div class="text-center mb-10 mb-lg-20">
              <h3 class="font-size-h1">
                Забыли пароль ?
              </h3>
              <p class="text-muted font-weight-bold">
                Введите свой email, чтобы сбросить пароль
              </p>
            </div>
            <form
              id="kt_login_forgot_form"
              class="form"
              novalidate
            >
              <div class="form-group">
                <input
                  id="forgotFormEmail"
                  type="email"
                  class="form-control form-control-solid h-auto py-5 px-6"
                  placeholder="Email"
                >
              </div>
              <div class="form-group d-flex flex-wrap flex-center">
                <button
                  id="kt_login_forgot_submit"
                  type="submit"
                  class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4"
                >
                  Сбросить пароль
                </button>
                <button
                  id="kt_login_forgot_cancel"
                  type="button"
                  class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-4"
                  @click="showForm('signin')"
                >
                  Отмена
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="d-flex d-lg-none flex-column-auto flex-column flex-sm-row justify-content-between align-items-center mt-5 p-5">
          <div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">
            &copy; {{ year }} {{ appName }}
          </div>
          <div class="d-flex order-1 order-sm-2 my-2">
            <a
              href=""
              class="text-dark-75 text-hover-primary"
            >
              Помощь
            </a>
            <a
              href=""
              class="text-dark-75 text-hover-primary ml-4"
            >
              Разработчикам
            </a>
            <a
              href=""
              class="text-dark-75 text-hover-primary ml-4"
            >
              Связаться с нами
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import { SET_PAGE_TITLE } from '../store/mutation-types.js'

export default {
  data () {
    return {
      isLoading: false,
      forms: {
        signIn: {
          errors: {},
          data: {
            email: '',
            password: ''
          }
        },
        signUp: {
          errors: {},
          data: {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
          }
        }
      }
    }
  },

  computed: {
    /**
     * @returns {number}
     */
    year () {
      return new Date().getFullYear()
    },

    /**
     * @returns {string}
     */
    appName () {
      return require('../config.js').APP_NAME
    },

    /**
     * @returns {string}
     */
    backgroundImage () {
      return require('../assets/media/bg/bg-4.jpg')
    }
  },

  mounted () {
    document.getElementById('signInFormEmail').focus()
  },

  methods: {
    /**
     * Shows form.
     *
     * @param {string} from - The form name
     */
    showForm (form) {
      document.getElementById('kt_login')
        .classList
        .remove('login-signin-on')

      document.getElementById('kt_login')
        .classList
        .remove('login-signup-on')

      document.getElementById('kt_login')
        .classList
        .remove('login-forgot-on')

      document.getElementById('kt_login')
        .classList
        .add(`login-${form}-on`)

      switch (form) {
        case 'signin':
          document.getElementById('signInFormEmail').focus()
          this.$store.commit(SET_PAGE_TITLE, 'Войти')
          break
        case 'signup':
          document.getElementById('signUpFormName').focus()
          this.$store.commit(SET_PAGE_TITLE, 'Создать аккаунт')
          break
        case 'forgot':
          document.getElementById('forgotFormEmail').focus()
          this.$store.commit(SET_PAGE_TITLE, 'Сбросить пароль')
          break
      }

      window.KTUtil.animateClass(
        document.getElementById(`kt_login_${form}_form`), 'animate__animated animate__backInUp'
      )
    },

    /**
     * Submits the sign in form.
     */
    submitSignInForm () {
      this.forms.signIn.errors = {}
      this.isLoading = true

      document.getElementById('kt_login_signin_submit')
        .classList
        .add(
          'spinner',
          'spinner-light',
          'spinner-right'
        )

      this.$store.dispatch('login', this.forms.signIn.data)
        .finally(() => {
          this.isLoading = false

          document.getElementById('kt_login_signin_submit')
            .classList
            .remove(
              'spinner',
              'spinner-light',
              'spinner-right'
            )
        })
        .then(() => {
          if (this.$store.state.isTwoFactor) {
            //
          } else {
            this.$router.push({
              name: 'Home'
            })
          }
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.forms.signIn.errors = error.response.data.errors
          } else {
            window.toastr
              .error(
                'Попробуйте перезагрузить страницу.', 'Ошибка'
              )
          }
        })
    },

    /**
     * Submits the sign up form.
     */
    submitSignUpForm () {
      this.forms.signUp.errors = {}
      this.isLoading = true

      document.getElementById('kt_login_signup_submit')
        .classList
        .add(
          'spinner',
          'spinner-light',
          'spinner-right'
        )

      axios.post('/users/register', this.forms.signUp.data)
        .finally(() => {
          this.isLoading = false

          document.getElementById('kt_login_signup_submit')
            .classList
            .remove(
              'spinner',
              'spinner-light',
              'spinner-right'
            )
        })
        .then(() => {
          //
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.forms.signUp.errors = error.response.data.errors
          } else {
            window.toastr
              .error(
                'Попробуйте перезагрузить страницу.', 'Ошибка'
              )
          }
        })
    }
  }
}
</script>

<style
  lang="scss"
  scoped
>
@import "../assets/sass/pages/login/classic/login-1.scss";

.spinner.spinner-right {
  padding-right: 3.5rem !important;
}
</style>
