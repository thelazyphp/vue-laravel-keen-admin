<template>
  <div class="d-flex flex-column flex-root">
    <div
      id="kt_login"
      ref="kt_login"
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
              id="kt_login_signin_form"
              ref="kt_login_signin_form"
              class="form"
            >
              <div class="form-group mb-5">
                <input
                  v-model="signInForm.username"
                  type="text"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  name="username"
                  placeholder="Имя пользователя"
                  autocomplete="off"
                >
              </div>
              <div class="form-group mb-5">
                <input
                  v-model="signInForm.password"
                  type="password"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  name="password"
                  placeholder="Пароль"
                >
              </div>
              <button
                id="kt_login_signin_submit"
                ref="kt_login_signin_submit"
                type="submit"
                class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4"
                @click="handleSignInForm"
              >
                Войти
              </button>
            </form>
            <div class="mt-10">
              <span class="opacity-70 mr-4">Еще нет аккаунта?</span>
              <a
                id="kt_login_signup"
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
              id="kt_login_signup_form"
              ref="kt_login_signup_form"
              class="form"
            >
              <div class="form-group mb-5">
                <input
                  v-model="signUpForm.l_name"
                  type="text"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  name="l_name"
                  placeholder="Фамилия"
                >
              </div>
              <div class="form-group mb-5">
                <input
                  v-model="signUpForm.f_name"
                  type="text"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  name="f_name"
                  placeholder="Имя"
                >
              </div>
              <div class="form-group mb-5">
                <input
                  v-model="signUpForm.m_name"
                  type="text"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  name="m_name"
                  placeholder="Отчество"
                >
              </div>
              <div class="form-group mb-5">
                <input
                  v-model="signUpForm.company_name"
                  type="text"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  name="company_name"
                  placeholder="Название организации"
                >
              </div>
              <div class="form-group mb-5">
                <input
                  v-model="signUpForm.username"
                  type="text"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  name="username"
                  placeholder="Имя пользователя"
                  autocomplete="off"
                >
              </div>
              <div class="form-group mb-5">
                <input
                  v-model="signUpForm.password"
                  type="password"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  name="password"
                  placeholder="Пароль"
                >
              </div>
              <div class="form-group mb-5">
                <input
                  v-model="signUpForm.password_confirmation"
                  type="password"
                  class="form-control h-auto form-control-solid py-4 px-8"
                  name="password_confirmation"
                  placeholder="Подтвердите пароль"
                  @paste.prevent
                >
              </div>
              <div class="form-group d-flex flex-wrap flex-center mt-10">
                <button
                  id="kt_login_signup_submit"
                  ref="kt_login_signup_submit"
                  type="submit"
                  class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2"
                  @click="handleSignUpForm"
                >
                  Создать
                </button>
                <button
                  id="kt_login_signup_cancel"
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
import { mapMutations, mapActions } from "vuex"
import {
  SET_PAGE_TITLE
} from "../store"
import {
  LOGIN
} from "../store/auth.module.js"
import UsersService from "../services/users.service.js"

export default {
  data () {
    return {
      signInForm: {
        username: null,
        password: null
      },
      signUpForm: {
        company_name: null,
        f_name: null,
        m_name: null,
        l_name: null,
        username: null,
        password: null,
        password_confirmation: null
      }
    }
  },
  computed: {
    backgroundImage () {
      return require("../assets/media/bg/bg-3.jpg")
    },
    logo () {
      return require("../assets/media/logos/logo-letter-13.png")
    },
    signInFormValidation () {
      return window.FormValidation.formValidation(this.$refs["kt_login_signin_form"], {
        fields: {
          username: {
            validators: {
              notEmpty: {
                message: "Введите имя пользователя"
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: "Введите пароль"
              }
            }
          }
        },
        plugins: {
          trigger: new window.FormValidation.plugins.Trigger(),
          bootstrap: new window.FormValidation.plugins.Bootstrap(),
          submitButton: new window.FormValidation.plugins.SubmitButton()
        }
      })
    },
    signUpFormValidation () {
      return window.FormValidation.formValidation(this.$refs["kt_login_signup_form"], {
        fields: {
          l_name: {
            validators: {
              notEmpty: {
                message: "Введите фамилию"
              },
              stringLength: {
                max: 191,
                message: "Фамилия не может превышать 191 символ"
              }
            }
          },
          f_name: {
            validators: {
              notEmpty: {
                message: "Введите имя"
              },
              stringLength: {
                max: 191,
                message: "Имя не может превышать 191 символ"
              }
            }
          },
          m_name: {
            validators: {
              stringLength: {
                max: 191,
                message: "Отчество не может превышать 191 символ"
              }
            }
          },
          username: {
            validators: {
              notEmpty: {
                message: "Введите имя пользователя"
              },
              regexp: {
                regexp: /^[a-z][a-z0-9_]*$/,
                flags: "i",
                message: "Имя пользователя должно начинаться с латинской буквы и включать только латинские буквы, цифры и знаки нижнего подчеркивания"
              },
              stringLength: {
                max: 191,
                message: "Имя пользователя не может превышать 191 символ"
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: "Введите пароль"
              },
              stringLength: {
                min: 8,
                message: "Пароль должен состоять минимум из 8 символов"
              }
            }
          },
          password_confirmation: {
            validators: {
              notEmpty: {
                message: "Подтвердите пароль"
              },
              identical: {
                compare: () => {
                  return document.getElementById("kt_login_signup_form").querySelector("[name='password']").value
                },
                message: "Пароли должны совпадать"
              }
            }
          }
        },
        plugins: {
          trigger: new window.FormValidation.plugins.Trigger(),
          bootstrap: new window.FormValidation.plugins.Bootstrap(),
          submitButton: new window.FormValidation.plugins.SubmitButton()
        }
      })
    }
  },
  beforeMount () {
    this[SET_PAGE_TITLE]("Войти в аккаунт")
  },
  methods: {
    ...mapMutations([
      SET_PAGE_TITLE
    ]),
    ...mapActions([
      "auth/" + LOGIN
    ]),
    showSignInForm () {
      this.$refs["kt_login"].classList.remove("login-signup-on")
      this.$refs["kt_login"].classList.add("login-signin-on")
      this[SET_PAGE_TITLE]("Войти в аккаунт")
      window.KTUtil.animateClass(
        this.$refs["kt_login_signin_form"], "animate__animated animate__backInUp"
      )
    },
    showSignUpForm () {
      this.$refs["kt_login"].classList.remove("login-signin-on")
      this.$refs["kt_login"].classList.add("login-signup-on")
      this[SET_PAGE_TITLE]("Создать аккаунт")
      window.KTUtil.animateClass(
        this.$refs["kt_login_signup_form"], "animate__animated animate__backInUp"
      )
    },
    handleSignInForm () {
      this.signInFormValidation.validate()
        .then(status => {
          if (status === "Valid") {
            window.swal.fire({
              text: "Все хорошо!",
              icon: "success",
              buttonsStyling: false,
              confirmButtonText: "Отправить форму",
              customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary"
              }
            })
            .then(() => {
              window.KTUtil.scrollTop()

              this.$refs["kt_login_signin_submit"].classList.add(
                "spinner", "spinner-light", "spinner-right"
              )

              this["auth/" + LOGIN](this.signInForm)
                .then(() => {
                  this.$router.push({
                    name: "dashboard"
                  })
                })
                .catch(error => {
                  console.log(error)

                  if (error.response.status === 400) {
                    window.swal.fire({
                      text: "Неверное имя пользователя или пароль!",
                      icon: "error",
                      buttonsStyling: false,
                      confirmButtonText: "Попробовать снова",
                      customClass: {
                        confirmButton: "btn font-weight-bold btn-light-primary"
                      }
                    })
                    .then(() => {
                      this.signInFormValidation.resetForm(true)
                      window.KTUtil.scrollTop()
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
                    .then(() => {
                      this.signInFormValidation.resetForm(true)
                      window.KTUtil.scrollTop()
                    })
                  }
                })
                .finally(() => {
                  this.$refs["kt_login_signin_submit"].classList.remove(
                    "spinner", "spinner-light", "spinner-right"
                  )
                })
            })
          } else {
            window.swal.fire({
              text: "Форма заполнена с ошибками!",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Исправить ошибки",
              customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary"
              }
            })
            .then(() => {
              window.KTUtil.scrollTop()
            })
          }
        })
    },
    handleSignUpForm () {
      this.signUpFormValidation.validate()
        .then(status => {
          if (status === "Valid") {
            window.swal.fire({
              text: "Все хорошо!",
              icon: "success",
              buttonsStyling: false,
              confirmButtonText: "Отправить форму",
              customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary"
              }
            }).then(() => {
              window.KTUtil.scrollTop()

              this.$refs["kt_login_signup_submit"].classList.add(
                "spinner", "spinner-light", "spinner-right"
              )

              UsersService.register(this.signUpForm)
                .then(() => {
                  this["auth/" + LOGIN]({
                    username: this.signUpForm.username,
                    password: this.signUpForm.password
                  })
                  .then(() => {
                    this.$router.push({
                      name: "dashboard"
                    })
                  })
                })
                .catch(error => {
                  console.log(error)

                  window.swal.fire({
                    text: "При создании аккаунта произошла ошибка!",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Попробовать снова",
                    customClass: {
                      confirmButton: "btn font-weight-bold btn-light-primary"
                    }
                  })
                  .then(() => {
                    this.signUpFormValidation.resetForm(true)
                    window.KTUtil.scrollTop()
                  })
                })
                .finally(() => {
                  this.$refs["kt_login_signup_submit"].classList.remove(
                    "spinner", "spinner-light", "spinner-right"
                  )
                })
            })
          } else {
            window.swal.fire({
              text: "Форма заполнена с ошибками!",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Исправить ошибки",
              customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary"
              }
            }).then(() => {
              window.KTUtil.scrollTop()
            })
          }
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
