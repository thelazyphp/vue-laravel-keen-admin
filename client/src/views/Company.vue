<template>
  <div class="card card-custom">
    <div class="card-body px-7">
      <form
        class="form"
        @submit.prevent="submitForm"
      >
        <div class="card-body">
          <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-7 my-2">
              <div class="form-group row">
                <label
                  for="name"
                  class="col-form-label col-lg-3 text-lg-right text-left"
                >
                  Название
                </label>
                <div class="col-lg-9">
                  <input
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="form-control form-control-lg form-control-solid"
                    :class="{
                      'is-invalid': this.errors.name
                    }"
                    :readonly="!userIsAdmin"
                  >
                  <div
                    v-for="(error, index) in this.errors.name"
                    :key="index"
                    class="invalid-feedback"
                  >
                    {{ error }}
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label
                  for="website"
                  class="col-form-label col-lg-3 text-lg-right text-left"
                >
                  Сайт
                </label>
                <div class="col-lg-9">
                  <div
                    class="input-group input-group-lg input-group-solid"
                    :class="{
                      'is-invalid': this.errors.website
                    }"
                  >
                    <input
                      id="website"
                      v-model="form.website"
                      type="url"
                      class="form-control form-control-lg form-control-solid"
                      :class="{
                        'is-invalid': this.errors.website
                      }"
                      :readonly="!userIsAdmin"
                    >
                    <div class="input-group-append">
                      <span class="input-group-text">.com</span>
                    </div>
                  </div>
                  <div
                    v-for="(error, index) in this.errors.website"
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
                      'is-invalid': this.errors.email
                    }"
                  >
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="la la-at"></i>
                      </span>
                    </div>
                    <input
                      id="email"
                      v-model="form.email"
                      type="email"
                      class="form-control form-control-lg form-control-solid"
                      :class="{
                        'is-invalid': this.errors.email
                      }"
                      :readonly="!userIsAdmin"
                    >
                  </div>
                  <div
                    v-for="(error, index) in this.errors.email"
                    :key="index"
                    class="invalid-feedback"
                  >
                    {{ error }}
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label
                  for="phone"
                  class="col-form-label col-lg-3 text-lg-right text-left"
                >
                  Номер телефона
                </label>
                <div class="col-lg-9">
                  <div
                    class="input-group input-group-lg input-group-solid"
                    :class="{
                      'is-invalid': this.errors.phone
                    }"
                  >
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="la la-phone"></i>
                      </span>
                    </div>
                    <input
                      id="phone"
                      v-model="form.phone"
                      type="phone"
                      class="form-control form-control-lg form-control-solid"
                      :class="{
                        'is-invalid': this.errors.phone
                      }"
                      :readonly="!userIsAdmin"
                    >
                  </div>
                  <div
                    v-for="(error, index) in this.errors.phone"
                    :key="index"
                    class="invalid-feedback"
                  >
                    {{ error }}
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label
                  for="license"
                  class="col-form-label col-lg-3 text-lg-right text-left"
                >
                  Лицензия
                </label>
                <div class="col-lg-9">
                  <input
                    id="license"
                    v-model="form.license"
                    type="text"
                    class="form-control form-control-lg form-control-solid"
                    :class="{
                      'is-invalid': this.errors.license
                    }"
                    :readonly="!userIsAdmin"
                  >
                  <div
                    v-for="(error, index) in this.errors.license"
                    :key="index"
                    class="invalid-feedback"
                  >
                    {{ error }}
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label
                  for="address"
                  class="col-form-label col-lg-3 text-lg-right text-left"
                >
                  Адрес
                </label>
                <div class="col-lg-9">
                  <input
                    id="address"
                    v-model="form.address"
                    type="text"
                    class="form-control form-control-lg form-control-solid"
                    :class="{
                      'is-invalid': this.errors.address
                    }"
                    :readonly="!userIsAdmin"
                  >
                  <div
                    v-for="(error, index) in this.errors.address"
                    :key="index"
                    class="invalid-feedback"
                  >
                    {{ error }}
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label
                  for="description"
                  class="col-form-label col-lg-3 text-lg-right text-left"
                >
                  Описание
                </label>
                <div class="col-lg-9">
                  <textarea
                    id="description"
                    v-model="form.description"
                    class="form-control form-control-lg form-control-solid"
                    :class="{
                      'is-invalid': this.errors.description
                    }"
                    rows="3"
                    :readonly="!userIsAdmin"
                  >
                  </textarea>
                  <div
                    v-for="(error, index) in this.errors.description"
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
        <div
          v-if="userIsAdmin"
          class="card-footer pb-0"
        >
          <div class="row">
            <div class="col-xl-2"></div>
            <div class="col-xl-7">
              <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-9">
                  <button
                    ref="formSubmit"
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
</template>

<script>
import UsersService from "../services/users.service.js"

export default {
  data () {
    return {
      errors: {},
      form: {
        name: null,
        website: null,
        email: null,
        phone: null,
        license: null,
        address: null,
        description: null
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
     * @returns {boolean}
     */
    userIsAdmin () {
      return this.user.role === "admin"
    }
  },

  created () {
    this.initForm()
  },

  beforeMount () {
    this.$store.commit("setPageTitle", "Моя организация")
  },

  methods: {
    /**
     * Inits form.
     */
    initForm () {
      if (this.user.company) {
        this.form.name = this.user.company.name
        this.form.website = this.user.company.website
        this.form.email = this.user.company.email
        this.form.phone = this.user.company.phone
        this.form.license = this.user.company.license
        this.form.address = this.user.company.address
        this.form.description = this.user.company.description
      }
    },

    /**
     * Submits form.
     */
    submitForm () {
      if (!this.userIsAdmin) {
        return
      }

      this.errors = {}
      this.$refs["formSubmit"].classList.add("spinner", "spinner-light", "spinner-right")

      UsersService.updateCompany(this.user.id, this.form)
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
            this.errors = error.response.data.errors

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
            this.initForm()

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
          this.$refs["formSubmit"].classList.remove("spinner", "spinner-light", "spinner-right")
        })
    }
  }
}
</script>
