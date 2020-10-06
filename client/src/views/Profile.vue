<template>
  <div class="card card-custom">
    <div class="card-header card-header-tabs-line nav-tabs-line-3x">
      <div class="card-toolbar">
        <ul class="nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-3x">
          <li class="nav-item mr-3">
            <a
              href="#profileTab"
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
              href="#accountTab"
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
          id="profileTab"
          class="tab-pane show active px-7"
          role="tabpanel"
        >
          <form
            class="form"
            @submit.prevent="submitProfileForm"
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
                            backgroundImage: `url(${userAvatar})`
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
                            accept=".png, .jpg, .jpeg"
                            @change="uploadUserAvatar"
                          >
                          <input type="hidden">
                        </label>
                        <span
                          class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                          title="Удалить аватар"
                          data-action="cancel"
                          data-toggle="tooltip"
                          @click="removeUserAvatar"
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
                        v-model="profileForm.first_name"
                        type="text"
                        class="form-control form-control-lg form-control-solid"
                        :class="{
                          'is-invalid': this.errors.profileForm.first_name
                        }"
                      >
                      <div
                        v-for="(error, index) in this.errors.profileForm.first_name"
                        :key="index"
                        class="invalid-feedback"
                      >
                        {{ error }}
                      </div>
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
                        v-model="profileForm.last_name"
                        type="text"
                        class="form-control form-control-lg form-control-solid"
                        :class="{
                          'is-invalid': this.errors.profileForm.last_name
                        }"
                      >
                      <div
                        v-for="(error, index) in this.errors.profileForm.last_name"
                        :key="index"
                        class="invalid-feedback"
                      >
                        {{ error }}
                      </div>
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
                      <div
                        class="input-group input-group-lg input-group-solid"
                        :class="{
                          'is-invalid': this.errors.profileForm.email
                        }"
                      >
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="la la-at"></i>
                          </span>
                        </div>
                        <input
                          id="email"
                          v-model="profileForm.email"
                          type="email"
                          class="form-control form-control-lg form-control-solid"
                          :class="{
                            'is-invalid': this.errors.profileForm.email
                          }"
                        >
                      </div>
                      <div
                        v-for="(error, index) in this.errors.profileForm.email"
                        :key="index"
                        class="invalid-feedback"
                      >
                        {{ error }}
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
                      <div
                        class="input-group input-group-lg input-group-solid"
                        :class="{
                          'is-invalid': this.errors.profileForm.contact_phone
                        }"
                      >
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="la la-phone"></i>
                          </span>
                        </div>
                        <input
                          id="contactPhone"
                          v-model="profileForm.contact_phone"
                          type="phone"
                          class="form-control form-control-lg form-control-solid"
                          :class="{
                            'is-invalid': this.errors.profileForm.contact_phone
                          }"
                        >
                      </div>
                      <div
                        v-for="(error, index) in this.errors.profileForm.contact_phone"
                        :key="index"
                        class="invalid-feedback"
                      >
                        {{ error }}
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
                        ref="profileFormSubmit"
                        type="submit"
                        class="btn btn-light-primary font-weight-bold"
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
          id="accountTab"
          class="tab-pane px-7"
          role="tabpanel"
        >
          <form
            class="form"
            @submit.prevent="submitAccountForm"
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
                          v-model="accountForm.username"
                          type="text"
                          class="form-control form-control-lg form-control-solid"
                          :class="{
                            'is-invalid': this.errors.accountForm.username
                          }"
                          autocomplete="off"
                        >
                        <div
                          v-for="(error, index) in this.errors.accountForm.username"
                          :key="index"
                          class="invalid-feedback"
                        >
                          {{ error }}
                        </div>
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
                        v-model="accountForm.cur_password"
                        type="password"
                        class="form-control form-control-lg form-control-solid"
                        :class="{
                          'is-invalid': this.errors.accountForm.cur_password
                        }"
                      >
                      <div
                        v-for="(error, index) in this.errors.accountForm.cur_password"
                        :key="index"
                        class="invalid-feedback"
                      >
                        {{ error }}
                      </div>
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
                        v-model="accountForm.new_password"
                        type="password"
                        class="form-control form-control-lg form-control-solid"
                        :class="{
                          'is-invalid': this.errors.accountForm.new_password
                        }"
                      >
                      <div
                        v-for="(error, index) in this.errors.accountForm.new_password"
                        :key="index"
                        class="invalid-feedback"
                      >
                        {{ error }}
                      </div>
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
                        v-model="accountForm.new_password_confirmation"
                        type="password"
                        class="form-control form-control-lg form-control-solid"
                        :class="{
                          'is-invalid': this.errors.accountForm.new_password_confirmation
                        }"
                        @paste.prevent
                      >
                      <div
                        v-for="(error, index) in this.errors.accountForm.new_password_confirmation"
                        :key="index"
                        class="invalid-feedback"
                      >
                        {{ error }}
                      </div>
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
                        ref="accountFormSubmit"
                        type="submit"
                        class="btn btn-light-primary font-weight-bold"
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
import UsersService from "../services/users.service.js"

export default {
  data () {
    return {
      errors: {
        profileForm: {},
        accountForm: {}
      },
      profileForm: {
        first_name: null,
        last_name: null,
        email: null,
        contact_phone: null
      },
      accountForm: {
        username: null,
        cur_password: null,
        new_password: null,
        new_password_confirmation: null
      }
    }
  },

  computed: {
    /**
     * @returns {object}
     */
    user () {
      return this.$store.getters.user
    },

    /**
     * @returns {*}
     */
    defaultUserAvatar () {
      return require("../assets/media/users/blank.png")
    },

    /**
     * @returns {(*|string)}
     */
    userAvatar () {
      return this.user.image ? this.user.image.url : this.defaultUserAvatar
    }
  },

  created () {
    this.initProfileForm()
    this.initAccountForm()
  },

  beforeMount () {
    this.$store.commit("setPageTitle", "Мой профиль")
  },

  mounted () {
    new window.KTImageInput("userAvatar")
  },

  methods: {
    /**
     * Inits the profile form.
     */
    initProfileForm () {
      this.profileForm.first_name = this.user.first_name
      this.profileForm.last_name = this.user.last_name
      this.profileForm.email = this.user.email
      this.profileForm.contact_phone = this.user.contact_phone
    },

    /**
     * Inits the account form.
     */
    initAccountForm () {
      this.accountForm.username = this.user.username
    },

    /**
     * Uploads the user avatar.
     *
     * @param {Event} event
     */
    uploadUserAvatar (event) {
      if (event.target.files.length) {
        UsersService.uploadImage(event.target.files[0])
          .then(res => {
            UsersService.updateProfile(this.user.id, {
              image_id: res.data.id
            })
            .then(res => {
              this.$store.commit("setUser", res.data.data)
            })
            .catch(() /* error */ => {
              // console.log(error)

              window.swal.fire({
                text: "При изменении аватара произошла ошибка!",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Попробовать снова",
                customClass: {
                  confirmButton: "btn font-weight-bold btn-light-primary"
                }
              })
            })
          })
          .catch(() /* error */ => {
            // console.log(error)

            window.swal.fire({
              text: "При загрузке файла произошла ошибка!",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Попробовать снова",
              customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary"
              }
            })
          })
      }
    },

    /**
     * Removes the user avatar.
     */
    removeUserAvatar () {
      UsersService.updateProfile(this.user.id, {
        image_id: null
      })
      .then(res => {
        this.$store.commit("setUser", res.data.data)
      })
      .catch(() /* error */ => {
        // console.log(error)

        window.swal.fire({
          text: "При удалении аватара произошла ошибка!",
          icon: "error",
          buttonsStyling: false,
          confirmButtonText: "Попробовать снова",
          customClass: {
            confirmButton: "btn font-weight-bold btn-light-primary"
          }
        })
      })
    },

    /**
     * Submits the profile form.
     */
    submitProfileForm () {
      this.errors.profileForm = {}
      this.$refs["profileFormSubmit"].classList.add("spinner", "spinner-light", "spinner-right")

      UsersService.updateProfile(this.user.id, this.profileForm)
        .then(res => {
          this.$store.commit("setUser", res.data.data)

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
          // console.log(error)

          if (error.response.status === 422) {
            this.errors.profileForm = error.response.data.errors

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
            this.initProfileForm()

            window.swal.fire({
              text: "При сохранении изменений произошла ошибка!",
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
          this.$refs["profileFormSubmit"].classList.remove("spinner", "spinner-light", "spinner-right")
        })
    },

    /**
     * Submits the account form.
     */
    submitAccountForm () {
      this.errors.accountForm = {}
      this.$refs["accountFormSubmit"].classList.add("spinner", "spinner-light", "spinner-right")

      let data = {
        username: this.accountForm.username
      }

      if (this.accountForm.new_password) {
        data["new_password"] = this.accountForm.new_password
        data["cur_password"] = this.accountForm.cur_password
        data["new_password_confirmation"] = this.accountForm.new_password_confirmation
      }

      UsersService.updateAccount(this.user.id, data)
        .then(res => {
          this.$store.commit("setUser", res.data.data)

          this.accountForm.cur_password = null
          this.accountForm.new_password = null
          this.accountForm.new_password_confirmation = null

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
          // console.log(error)

          if (error.response.status === 422) {
            this.errors.accountForm = error.response.data.errors

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
            this.initAccountForm()

            window.swal.fire({
              text: "При сохранении изменений произошла ошибка!",
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
          this.$refs["accountFormSubmit"].classList.remove("spinner", "spinner-light", "spinner-right")
        })
    }
  }
}
</script>

<style lang="scss" scoped>
@import "@/assets/sass/pages/wizard/wizard-4.scss";
</style>
