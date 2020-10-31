<template>
  <div class="d-flex flex-column flex-root">
    <div
      id="kt_login"
      class="login login-2 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white"
    >
      <div class="login-aside order-2 order-lg-1 d-flex flex-row-auto position-relative overflow-hidden">
        <div class="d-flex flex-column-fluid flex-column justify-content-between py-9 px-7 py-lg-13 px-lg-35">
          <router-link
            to="/"
            class="text-center pt-2"
          >
            <img
              alt=""
              :src="logo"
              class="max-h-75px"
            >
          </router-link>
          <div class="d-flex flex-column-fluid flex-column flex-center">
            <div class="login-form login-signin py-11">
              <form
                id="kt_login_signin_form"
                class="form"
                novalidate
                @submit.prevent="submitSignInForm"
              >
                <div class="text-center pb-8">
                  <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Войти</h2>
                  <span class="text-muted font-weight-bold font-size-h4">
                    Или
                    <a
                      id="kt_login_signup"
                      href=""
                      class="text-primary font-weight-bolder"
                      @click.prevent="showForm(signUpFormName)"
                    >
                      создать аккаунт
                    </a>
                  </span>
                </div>
                <div class="form-group">
                    <label
                      for="signInFormEmail"
                      class="font-size-h6 font-weight-bolder text-dark"
                    >
                      Email
                    </label>
                    <input
                      id="signInFormEmail"
                      v-model="signInForm.email"
                      type="email"
                      class="form-control form-control-solid h-auto py-7 px-6 rounded-lg"
                      :class="{
                        'is-invalid': signInForm.errors.email
                      }"
                      autocomplete="off"
                    >
                    <InvalidFeedback :errors="signInForm.errors.email"/>
                </div>
                <div class="form-group">
                  <div class="d-flex justify-content-between mt-n5">
                    <label
                      for="signInFormPassword"
                      class="font-size-h6 font-weight-bolder text-dark pt-5"
                    >
                      Пароль
                    </label>
                  </div>
                  <input
                    id="signInFormPassword"
                    v-model="signInForm.password"
                    type="password"
                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg"
                    :class="{
                      'is-invalid': signInForm.errors.password
                    }"
                    autocomplete="off"
                  >
                  <InvalidFeedback :errors="signInForm.errors.password"/>
                </div>
                <div class="text-center pt-2">
                  <button
                    id="kt_login_signin_submit"
                    type="submit"
                    class="btn btn-dark font-weight-bolder font-size-h6 px-8 py-4 my-3"
                  >
                    Войти
                  </button>
                </div>
              </form>
            </div>
            <div class="login-form login-signup pt-11">
              <form
                id="kt_login_signup_form"
                class="form"
                novalidate
                @submit.prevent="submitSignUpForm"
              >
                <div class="text-center pb-8">
                  <h2 class="font-weight-bolder text-dark font-size-h2 font-size-h1-lg">Создать аккаунт</h2>
                  <p class="text-muted font-weight-bold font-size-h4">Введите свои данные, чтобы создать аккаунт</p>
                </div>
                <div class="form-group">
                  <input
                    v-model="signUpForm.name"
                    type="text"
                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                    :class="{
                      'is-invalid': signUpForm.errors.name
                    }"
                    placeholder="Имя"
                    autocomplete="off"
                  >
                  <InvalidFeedback :errors="signUpForm.errors.name"/>
                </div>
                <div class="form-group">
                  <input
                    v-model="signUpForm.email"
                    type="email"
                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                    :class="{
                      'is-invalid': signUpForm.errors.email
                    }"
                    placeholder="Email"
                    autocomplete="off"
                  >
                  <InvalidFeedback :errors="signUpForm.errors.email"/>
                </div>
                <div class="form-group">
                  <input
                    v-model="signUpForm.password"
                    type="password"
                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                    :class="{
                      'is-invalid': signUpForm.errors.password
                    }"
                    placeholder="Пароль"
                    autocomplete="off"
                  >
                  <InvalidFeedback :errors="signUpForm.errors.password"/>
                </div>
                <div class="form-group">
                  <input
                    v-model="signUpForm.password_confirmation"
                    type="password"
                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                    :class="{
                      'is-invalid': signUpForm.errors.password_confirmation
                    }"
                    placeholder="Подтвердите пароль"
                    autocomplete="off"
                    @paste.prevent
                  >
                  <InvalidFeedback :errors="signUpForm.errors.password_confirmation"/>
                </div>
                <div class="form-group d-flex flex-wrap flex-center pb-lg-0 pb-3">
                  <button
                    id="kt_login_signup_submit"
                    type="submit"
                    class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4"
                  >
                    Отправить
                  </button>
                  <button
                    id="kt_login_signup_cancel"
                    type="button"
                    class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mx-4"
                    @click="showForm(signInFormName)"
                  >
                    Отмена
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div
        class="content order-1 order-lg-2 d-flex flex-column w-100 pb-0"
        style="background-color: #B1DCED"
      >
        <div class="d-flex flex-column justify-content-center text-center pt-lg-40 pt-md-5 pt-sm-5 px-lg-0 pt-5 px-7">
          <h3
            class="display4 font-weight-bolder my-7 text-dark"
            style="color: #986923"
          >
            {{ appName }}
          </h3>
          <p class="font-weight-bolder font-size-h2-md font-size-lg text-dark opacity-70">Парсер объявлений об аренде и продаже недвижимости</p>
        </div>
        <div
          class="content-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
          :style="{
            backgroundImage: `url(${backgroundImage})`
          }"
        >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Users from '../services/users.js'
import InvalidFeedback from '../components/InvalidFeedback.vue'

export default {
  components: {
    InvalidFeedback
  },

  data () {
    return {
      signInForm: {
        errors: {},
        email: '',
        password: ''
      },

      signUpForm: {
        errors: {},
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },

  computed: {
    /**
     * @returns {string}
     */
    signInFormName () {
      return 'signin'
    },

    /**
     * @returns {string}
     */
    signUpFormName () {
      return 'signup'
    },

    logo () {
      return require('../assets/media/logos/Logo.png')
    },

    /**
     * @returns {string}
     */
    appName () {
      return 'Realty'
    },

    backgroundImage () {
      return require('../assets/media/svg/illustrations/login-visual-2.svg')
    }
  },

  methods: {
    /**
     * Shows form.
     *
     * @param {string} from - The form name
     */
    showForm (form) {
      document.getElementById('kt_login').classList.remove('login-signin-on')
      document.getElementById('kt_login').classList.remove('login-signup-on')

      document.getElementById('kt_login').classList.add(`login-${form}-on`)

      window.KTUtil.animateClass(document.getElementById(`kt_login_${form}_form`), 'animate__animated animate__backInUp')
    },

    /**
     * Submits the sign in form.
     */
    submitSignInForm () {
      this.signInForm.errors = {}

      const data = {
        email: this.signInForm.email,
        password: this.signInForm.password
      }

      this.$store.dispatch('auth/login', data)
        .then(() => {
          this.$router.push({
            name: 'Home'
          })
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.signInForm.errors = error.response.data.errors
          }
        })
    },

    /**
     * Submits the sign up form.
     */
    submitSignUpForm () {
      this.signUpForm.errors = {}

      const data = {
        name: this.signUpForm.name,
        email: this.signUpForm.email,
        password: this.signUpForm.password,
        password_confirmation: this.signUpForm.password_confirmation
      }

      Users.register(data)
        .then(() => {
          const data = {
            email: this.signUpForm.email,
            password: this.signUpForm.password
          }

          this.$store.dispatch('auth/login', data)
            .then(() => {
              this.$router.push({
                name: 'Home'
              })
            })
        })
        .catch(error => {
          if (error.response.status === 422) {
            this.signUpForm.errors = error.response.data.errors
          }
        })
    }
  }
}
</script>

<style lang="scss" scoped>
@import "../assets/sass/pages/login/login-2.scss";
</style>
