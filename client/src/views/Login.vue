<template>
  <div class="d-flex flex-column flex-root">
    <div
      ref="login"
      class="login login-4 login-signin-on d-flex flex-row-fluid"
    >
      <div
        class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat"
        :style="{
          backgroundImage: `url(${backgroundImage})`
        }"
      >
        <div class="login-form text-center p-7 position-relative overflow-hidden">
          <div class="d-flex flex-center mb-15">
            <router-link to="/">
              <img
                :src="logo"
                class="max-h-75px"
                alt=""
              >
            </router-link>
          </div>
          <div class="login-signin">
            <div class="mb-20">
              <h3>Войти в аккаунт</h3>
              <div class="text-muted font-weight-bold">Заполните форму, чтобы войти в аккаунт</div>
            </div>
            <form
              ref="signInForm"
              class="form"
              @submit.prevent="submitSignInForm"
            >
              <div class="form-group mb-5">
                <input
                  v-model="signInForm.username"
                  type="text"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  :class="{
                    'is-invalid': errors.signInForm.username
                  }"
                  placeholder="Имя пользователя"
                  autocomplete="off"
                >
                <div
                  v-for="(error, index) in errors.signInForm.username"
                  :key="index"
                  class="invalid-feedback"
                >
                  {{ error }}
                </div>
              </div>
              <div class="form-group mb-5">
                <input
                  v-model="signInForm.password"
                  type="password"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  :class="{
                    'is-invalid': errors.signInForm.password
                  }"
                  placeholder="Пароль"
                >
                <div
                  v-for="(error, index) in errors.signInForm.password"
                  :key="index"
                  class="invalid-feedback"
                >
                  {{ error }}
                </div>
              </div>
              <button
                ref="signInFormSubmit"
                type="submit"
                class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4"
              >
                Войти
              </button>
            </form>
            <div class="mt-10">
              <span class="opacity-70 mr-4">Еще нет аккаунта?</span>
              <a
                href=""
                class="text-muted text-hover-primary font-weight-bold"
                @click.prevent="showSignUpForm"
              >
                Создать аккаунт
              </a>
            </div>
          </div>
          <div class="login-signup">
            <div class="mb-20">
              <h3>Создать аккаунт</h3>
              <div class="text-muted font-weight-bold">Заполните форму, чтобы создать аккаунт</div>
            </div>
            <form
              ref="signUpForm"
              class="form"
              @submit.prevent="submitSignUpForm"
            >
              <div class="form-group mb-5">
                <input
                  v-model="signUpForm.first_name"
                  type="text"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  :class="{
                    'is-invalid': errors.signUpForm.first_name
                  }"
                  placeholder="Имя"
                >
                <div
                  v-for="(error, index) in errors.signUpForm.first_name"
                  :key="index"
                  class="invalid-feedback"
                >
                  {{ error }}
                </div>
              </div>
              <div class="form-group mb-5">
                <input
                  v-model="signUpForm.last_name"
                  type="text"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  :class="{
                    'is-invalid': errors.signUpForm.last_name
                  }"
                  placeholder="Фамилия"
                >
                <div
                  v-for="(error, index) in errors.signUpForm.last_name"
                  :key="index"
                  class="invalid-feedback"
                >
                  {{ error }}
                </div>
              </div>
              <div class="form-group mb-5">
                <input
                  v-model="signUpForm.company_name"
                  type="text"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  :class="{
                    'is-invalid': errors.signUpForm.company_name
                  }"
                  placeholder="Название организации"
                >
                <div
                  v-for="(error, index) in errors.signUpForm.company_name"
                  :key="index"
                  class="invalid-feedback"
                >
                  {{ error }}
                </div>
              </div>
              <div class="form-group mb-5">
                <input
                  v-model="signUpForm.username"
                  type="text"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  :class="{
                    'is-invalid': errors.signUpForm.username
                  }"
                  placeholder="Имя пользователя"
                  autocomplete="off"
                >
                <div
                  v-for="(error, index) in errors.signUpForm.username"
                  :key="index"
                  class="invalid-feedback"
                >
                  {{ error }}
                </div>
              </div>
              <div class="form-group mb-5">
                <input
                  v-model="signUpForm.password"
                  type="password"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  :class="{
                    'is-invalid': errors.signUpForm.password
                  }"
                  placeholder="Пароль"
                >
                <div
                  v-for="(error, index) in errors.signUpForm.password"
                  :key="index"
                  class="invalid-feedback"
                >
                  {{ error }}
                </div>
              </div>
              <div class="form-group mb-5">
                <input
                  v-model="signUpForm.password_confirmation"
                  type="password"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  :class="{
                    'is-invalid': errors.signUpForm.password_confirmation
                  }"
                  placeholder="Подтвердите пароль"
                  @paste.prevent
                >
                <div
                  v-for="(error, index) in errors.signUpForm.password_confirmation"
                  :key="index"
                  class="invalid-feedback"
                >
                  {{ error }}
                </div>
              </div>
              <div class="form-group d-flex flex-wrap flex-center mt-10">
                <button
                  ref="signUpFormSubmit"
                  type="submit"
                  class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2"
                >
                  Создать
                </button>
                <button
                  type="button"
                  class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2"
                  @click.prevent="showSignInForm"
                >
                  Отмена
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import UsersService from "../services/users.service.js"

export default {
  data () {
    return {
      errors: {
        signInForm: {},
        signUpForm: {}
      },
      signInForm: {
        username: null,
        password: null
      },
      signUpForm: {
        company_name: null,
        first_name: null,
        last_name: null,
        username: null,
        password: null,
        password_confirmation: null
      }
    }
  },

  computed: {
    /**
     * @returns {*}
     */
    backgroundImage () {
      return require("../assets/media/bg/bg-3.jpg")
    },

    /**
     * @returns {*}
     */
    logo () {
      return require("../assets/media/logos/logo-letter-13.png")
    }
  },

  beforeMount () {
    this.$store.commit("setPageTitle", "Войти в аккаунт")
  },

  methods: {
    /**
     * Shows the sign in form.
     */
    showSignInForm () {
      this.$refs["login"].classList.remove("login-signup-on")
      this.$refs["login"].classList.add("login-signin-on")
      this.$store.commit("setPageTitle", "Войти в аккаунт")
      window.KTUtil.animateClass(this.$refs["signInForm"], "animate__animated animate__backInUp")
    },

    /**
     * Shows the sign up form.
     */
    showSignUpForm () {
      this.$refs["login"].classList.remove("login-signin-on")
      this.$refs["login"].classList.add("login-signup-on")
      this.$store.commit("setPageTitle", "Создать аккаунт")
      window.KTUtil.animateClass(this.$refs["signUpForm"], "animate__animated animate__backInUp")
    },

    /**
     * Submits the sign in form.
     */
    submitSignInForm () {
      this.errors.signInForm = {}
      this.$refs["signInFormSubmit"].classList.add("spinner", "spinner-light", "spinner-right")

      this.$store.dispatch("auth/login", this.signInForm)
        .then(() => {
          this.$router.push({
            name: "dashboard"
          })
        })
        .catch(error => {
          // console.log(error)

          if (error.response.status === 422) {
            this.errors.signInForm = error.response.data.errors

            window.swal.fire({
              text: "Форма заполнена с ошибками!",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Исправить ошибки",
              customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary"
              }
            })
          } else if (error.response.status === 400) {
            window.swal.fire({
              text: "Введен неверный пароль!",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Попробовать снова",
              customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary"
              }
            })
          } else {
            window.swal.fire({
              text: "При входе в аккаунт произошла ошибка!",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Попробовать снова",
              customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary"
              }
            })
          }
        })
        .finally(() => {
          this.$refs["signInFormSubmit"].classList.remove("spinner", "spinner-light", "spinner-right")
        })
    },

    /**
     * Submits the sign up form.
     */
    submitSignUpForm () {
      this.errors.signUpForm = {}
      this.$refs["signUpFormSubmit"].classList.add("spinner", "spinner-light", "spinner-right")

      UsersService.register(this.signUpForm)
        .then(() => {
          this.$store.dispatch("auth/login", {
            username: this.signUpForm.username,
            password: this.signUpForm.password
          })
          .then(() => {
            this.$router.push({
              name: "dashboard"
            })
          })
          .catch(() /* error */ => {
            // console.log(error)
            this.showSignInForm()
          })
        })
        .catch(error => {
          // console.log(error)

          if (error.response.status === 422) {
            this.errors.signUpForm = error.response.data.errors

            window.swal.fire({
              text: "Форма заполнена с ошибками!",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Исправить ошибки",
              customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary"
              }
            })
          } else {
            window.swal.fire({
              text: "При создании аккаунта произошла ошибка!",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Попробовать снова",
              customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary"
              }
            })
          }
        })
        .finally(() => {
          this.$refs["signUpFormSubmit"].classList.remove("spinner", "spinner-light", "spinner-right")
        })
    }
  }
}
</script>

<style lang="scss" scoped>
@import "@/assets/sass/pages/login/classic/login-4.scss";

.spinner.spinner-right {
  padding-right: 3.5rem !important;
}
</style>
