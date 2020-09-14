<template>
  <form class="kt-form kt-form--label-right" @submit.prevent>
    <div class="kt-form__body">
			<div class="kt-section kt-section--first">
			  <div class="kt-section__body">
          <div class="form-group row">
						<label class="col-xl-3 col-lg-3 col-form-label">Название</label>
						<div class="col-lg-9 col-xl-6">
							<input v-model="form.name" type="text" class="form-control">
						</div>
					</div>
          <div class="form-group row">
						<label class="col-xl-3 col-lg-3 col-form-label">Сайт</label>
						<div class="col-lg-9 col-xl-6">
							<div class="input-group">
								<input v-model="form.website" type="url" class="form-control">
                <div class="input-group-append">
                  <span class="input-group-text">.com</span>
                </div>
							</div>
						</div>
					</div>
          <div class="form-group row">
						<label class="col-xl-3 col-lg-3 col-form-label">E-Mail</label>
						<div class="col-lg-9 col-xl-6">
							<div class="input-group">
								<div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="la la-at"></i>
                  </span>
                </div>
								<input v-model="form.email" type="email" class="form-control">
							</div>
						</div>
					</div>
          <div class="form-group row">
						<label class="col-xl-3 col-lg-3 col-form-label">Номер телефона</label>
						<div class="col-lg-9 col-xl-6">
							<div class="input-group">
								<div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="la la-phone"></i>
                  </span>
                </div>
								<input v-model="form.phone" type="text" class="form-control">
							</div>
						</div>
					</div>
          <div class="form-group row">
						<label class="col-xl-3 col-lg-3 col-form-label">УНП</label>
						<div class="col-lg-9 col-xl-6">
							<input v-model="form.licence" type="text" class="form-control">
						</div>
					</div>
          <div class="form-group row">
						<label class="col-xl-3 col-lg-3 col-form-label">Адрес</label>
						<div class="col-lg-9 col-xl-6">
							<input v-model="form.address" type="text" class="form-control">
						</div>
					</div>
          <div class="form-group row">
						<label class="col-xl-3 col-lg-3 col-form-label">Описание</label>
						<div class="col-lg-9 col-xl-6">
							<textarea v-model="form.description" class="form-control" rows="3"></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
    <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
    <div class="kt-form__actions">
      <div class="row">
        <div class="col-xl-3"></div>
        <div class="col-lg-9 col-xl-6">
          <button type="submit" class="btn btn-label-brand btn-bold">Сохранить</button>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
require('@/assets/js/pages/custom/users/edit.js')

export default {
  data () {
    return {
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
  validations: {
    form: {
      //
    }
  },
  computed: {
    user () {
      return this.$store.state.user
    }
  },
  created () {
    if (this.user.company) {
      this.form.name = this.user.company.name
      this.form.website = this.user.company.website
      this.form.email = this.user.company.email
      this.form.phone = this.user.company.phone
      this.form.license = this.user.company.license
      this.form.address = this.user.company.address
      this.form.description = this.user.company.description
    }
  }
}
</script>
