<template>
  <div class="card card-custom">
    <div class="card-header card-header-tabs-line nav-tabs-line-3x">
      <div class="card-toolbar">
        <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
          <li class="nav-item mr-3">
            <a
              href="#tab1"
              class="nav-link active"
              data-toggle="tab"
            >
              <span class="nav-icon">
                <span class="svg-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24"/>
                      <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000"/>
                      <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5"/>
                    </g>
                  </svg>
                </span>
              </span>
              <span class="nav-text font-size-lg">Профиль</span>
            </a>
          </li>
          <li class="nav-item mr-3">
            <a
              href="#tab2"
              class="nav-link"
              data-toggle="tab"
            >
              <span class="nav-icon">
                <span class="svg-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24"/>
                      <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"/>
                      <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3"/>
                      <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3"/>
                    </g>
                  </svg>
                </span>
              </span>
              <span class="nav-text font-size-lg">Аккаунт</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="card-body px-0">
      <div class="tab-content">
        <div
          id="tab1"
          class="tab-pane show active px-7"
          role="tabpanel"
        >
          <form
            ref="updateProfileForm"
            class="form"
          >
            <div class="card-body">
              <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-7 my-2">
                  <div class="row">
                    <label class="col-lg-3"></label>
                    <div class="col-lg-9">
                      <h6 class="text-dark font-weight-bold mb-10">Профиль:</h6>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-3 text-lg-right text-left">Аватар</label>
                    <div class="col-lg-9">
                      <div
                        id="userAvatar"
                        class="image-input image-input-outline"
                      >
                        <div
                          class="image-input-wrapper"
                          :style="{
                            backgroundImage: `url(${defaultAvatar})`
                          }"
                        >
                        </div>
                        <label
                          class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                          title=""
                          data-action="change"
                          data-toggle="tooltip"
                          data-original-title="Изменить аватар"
                        >
                          <i class="fa fa-pen icon-sm text-muted"></i>
                          <input
                            type="file"
                            name="file"
                            accept=".png, .jpg, .jpeg"
                          >
                          <input type="hidden">
                        </label>
                        <span
                          class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                          title="Удалить аватар"
                          data-action="cancel"
                          data-toggle="tooltip"
                        >
                          <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                      </div>
                      <span class="form-text text-muted">Допустимые типы файлов:  png, jpg, jpeg.</span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label
                      for="firstName"
                      class="col-form-label col-lg-3 text-lg-right text-left"
                    >
                      Имя
                    </label>
                    <div class="col-lg-9">
                      <input
                        id="firstName"
                        v-model="updateProfileForm.firstName"
                        type="text" class="form-control form-control-lg form-control-solid"
                        name="firstName"
                      >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label
                      for="lastName"
                      class="col-form-label col-lg-3 text-lg-right text-left"
                    >
                      Фамилия
                    </label>
                    <div class="col-lg-9">
                      <input
                        id="lastName"
                        v-model="updateProfileForm.lastName"
                        type="text"
                        class="form-control form-control-lg form-control-solid"
                        name="lastName"
                      >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label
                      for="email"
                      class="col-form-label col-lg-3 text-lg-right text-left"
                    >
                      E-Mail
                    </label>
                    <div class="col-lg-9">
                      <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="la la-at"></i>
                          </span>
                        </div>
                        <input
                          id="email"
                          v-model="updateProfileForm.email"
                          type="email" class="form-control form-control-lg form-control-solid"
                          name="email"
                        >
                      </div>
                      <span class="form-text text-muted">E-Mail будет виден только сотрудникам вашей организации.</span>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label
                      for="contactPhone"
                      class="col-form-label col-lg-3 text-lg-right text-left"
                    >
                      Контактный телефон
                    </label>
                    <div class="col-lg-9">
                      <div class="input-group input-group-lg input-group-solid">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="la la-phone"></i>
                          </span>
                        </div>
                        <input
                          id="contactPhone"
                          v-model="updateProfileForm.contactPhone"
                          type="phone"
                          class="form-control form-control-lg form-control-solid"
                          name="contactPhone"
                        >
                      </div>
                      <span class="form-text text-muted">Контактный телефон будет виден только сотрудникам вашей организации.</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer pb-0">
              <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-7">
                  <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-9">
                      <button
                        ref="updateProfileFormSubmit"
                        type="submit"
                        class="btn btn-light-primary font-weight-bold"
                        @click="handleUpdateProfileForm"
                      >
                        Сохранить изменения
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div
          id="tab2"
          class="tab-pane px-7"
          role="tabpanel"
        >
          <form
            ref="updateAccountForm"
            class="form"
          >
            <div class="card-body">
              <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-7 my-2">
                  <div class="row">
                    <label class="col-lg-3"></label>
                    <div class="col-lg-9">
                      <h6 class="text-dark font-weight-bold mb-10">Данные для входа:</h6>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label
                      for="username"
                      class="col-form-label col-lg-3 text-lg-right text-left"
                    >
                      Имя пользователя
                    </label>
                    <div class="col-lg-9">
                      <div ref="username">
                        <input
                          id="username"
                          v-model="updateAccountForm.username"
                          type="text"
                          class="form-control form-control-lg form-control-solid"
                          name="username"
                          autocomplete="off"
                        >
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="separator separator-dashed my-10"></div>
              <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-7 my-2">
                  <div class="row">
                    <label class="col-lg-3"></label>
                    <div class="col-lg-9">
                      <h6 class="text-dark font-weight-bold mb-10">Изменить пароль:</h6>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label
                      for="curPassword"
                      class="col-form-label col-lg-3 text-lg-right text-left"
                    >
                      Текущий пароль
                    </label>
                    <div class="col-lg-9">
                      <input
                        id="curPassword"
                        v-model="updateAccountForm.curPassword"
                        type="password"
                        class="form-control form-control-lg form-control-solid"
                        name="curPassword"
                      >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label
                      for="newPassword"
                      class="col-form-label col-lg-3 text-lg-right text-left"
                    >
                      Новый пароль
                    </label>
                    <div class="col-lg-9">
                      <input
                        id="newPassword"
                        v-model="updateAccountForm.newPassword"
                        type="password"
                        class="form-control form-control-lg form-control-solid"
                        name="newPassword"
                      >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label
                      for="newPasswordConfirmation"
                      class="col-form-label col-lg-3 text-lg-right text-left"
                    >
                      Подтвердите пароль
                    </label>
                    <div class="col-lg-9">
                      <input
                        id="newPasswordConfirmation"
                        v-model="updateAccountForm.newPasswordConfirmation"
                        type="password"
                        class="form-control form-control-lg form-control-solid"
                        name="newPasswordConfirmation"
                        @paste.prevent
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer pb-0">
              <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-7">
                  <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-9">
                      <button
                        ref="updateAccountFormSubmit"
                        type="submit"
                        class="btn btn-light-primary font-weight-bold"
                        @click="handleUpdateAccountForm"
                      >
                        Сохранить изменения
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex"
import {
  SET_PAGE_TITLE
} from "../store"
import UsersService from "../services/users.service.js"

export default {
  data () {
    return {
      updateProfileForm: {
        firstName: null,
        lastName: null,
        email: null,
        contactPhone: null
      },
      updateAccountForm: {
        username: null,
        curPassword: null,
        newPassword: null,
        newPasswordConfirmation: null
      }
    }
  },
  computed: {
    ...mapGetters([
      "user"
    ]),
    defaultAvatar () {
      return require("../assets/media/users/blank.png")
    },
    updateProfileFormValidation () {
      return window.FormValidation.formValidation(this.$refs["updateProfileForm"], {
        fields: {
          firstName: {
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
          lastName: {
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
          email: {
            validators: {
              emailAddress: {
                message: "E-Mail введен неверно"
              },
              stringLength: {
                max: 191,
                message: "E-Mail не может превышать 191 символ"
              }
            }
          },
          contactPhone: {
            validators: {
              regexp: {
                regexp: /^\+\d{1,3}\d{1,12}$/,
                message: "Контактный телефон введен неверно"
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
    updateAccountFormValidation () {
      return window.FormValidation.formValidation(this.$refs["updateAccountForm"], {
        fields: {
          username: {
            validators: {
              notEmpty: {
                message: "Введите имя пользователя"
              },
              callback: {
                callback (input) {
                  return /^[a-z]/i.test(input.value)
                },
                message: "Имя пользователя должно начинаться с буквы"
              },
              regexp: {
                regexp: /^[a-z][a-z0-9_.\-@]*$/i,
                message: "Допустимые символы: a-Z0-9_.-@"
              },
              stringLength: {
                max: 191,
                message: "Имя пользователя не может превышать 191 символ"
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
  created () {
    this.updateProfileForm.firstName = this.user.first_name
    this.updateProfileForm.lastName = this.user.last_name
    this.updateProfileForm.email = this.user.email
    this.updateProfileForm.contactPhone = this.user.contact_phone

    this.updateAccountForm.username = this.user.username
  },
  beforeMount () {
    this[SET_PAGE_TITLE]("Мой профиль")
  },
  mounted () {
    new window.KTImageInput("userAvatar")
  },
  methods: {
    ...mapMutations([
      SET_PAGE_TITLE
    ]),
    handleUpdateProfileForm () {
      this.updateProfileFormValidation.validate()
        .then(status => {
          if (status === "Valid") {
            this.$refs["updateProfileFormSubmit"].classList.add(
              "spinner", "spinner-light", "spinner-right"
            )

            UsersService.updateProfile(this.user.id, {
              first_name: this.updateProfileForm.firstName,
              last_name: this.updateProfileForm.lastName,
              email: this.updateProfileForm.email,
              contact_phone: this.updateProfileForm.contactPhone
            })
            .then(() => {
              window.swal.fire({
                text: "Изменения успешно сохранены!",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Продолжить",
                customClass: {
                  confirmButton: "btn font-weight-bold btn-light-primary"
                }
              })
            })
            .catch(error => {
              console.log(error)

              window.swal.fire({
                text: "Произошла неизвестная ошибка!",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Попробовать снова",
                customClass: {
                  confirmButton: "btn font-weight-bold btn-light-primary"
                }
              })
            })
            .finally(() => {
              this.updateProfileFormValidation.resetForm(false)

              this.$refs["updateProfileFormSubmit"].classList.remove(
                "spinner", "spinner-light", "spinner-right"
              )
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
          }
        })
    },
    handleUpdateAccountForm () {
      this.updateAccountFormValidation.validate()
        .then(status => {
          if (status === "Valid") {
            this.$refs["updateAccountFormSubmit"].classList.add(
              "spinner", "spinner-light", "spinner-right"
            )

            let data = {
              username: this.updateAccountForm.username
            }

            if (this.updateAccountForm.newPassword) {
              data["new_password"] = this.updateAccountForm.newPassword
              data["cur_password"] = this.updateAccountForm.curPassword
              data["new_password_confirmation"] = this.updateAccountForm.newPasswordConfirmation
            }

            UsersService.updateAccount(this.user.id, data)
              .then(() => {
                window.swal.fire({
                  text: "Изменения успешно сохранены!",
                  icon: "success",
                  buttonsStyling: false,
                  confirmButtonText: "Продолжить",
                  customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                  }
                })
              })
              .catch(error => {
                console.log(error)

                window.swal.fire({
                  text: "Произошла неизвестная ошибка!",
                  icon: "error",
                  buttonsStyling: false,
                  confirmButtonText: "Попробовать снова",
                  customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                  }
                })
              })
              .finally(() => {
                this.updateAccountFormValidation.resetForm(false)

                this.updateAccountForm.newPassword = null
                this.updateAccountForm.curPassword = null
                this.updateAccountForm.newPasswordConfirmation = null

                this.$refs["updateAccountFormSubmit"].classList.remove(
                  "spinner", "spinner-light", "spinner-right"
                )
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
          }
        })
    }
  }
}
</script>

<style lang="scss" scoped>
@import "@/assets/sass/pages/wizard/wizard-4.scss";
</style>
