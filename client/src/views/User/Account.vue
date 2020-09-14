<template>
  <form class="kt-form kt-form--label-right" @submit.prevent>
    <div class="kt-form__body">
			<div class="kt-section kt-section--first">
			  <div class="kt-section__body">
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
						<label class="col-xl-3 col-lg-3 col-form-label">Текущий пароль</label>
						<div class="col-lg-9 col-xl-6">
							<input v-model="form.cur_password" type="password" class="form-control">
						</div>
					</div>
          <div class="form-group row">
						<label class="col-xl-3 col-lg-3 col-form-label">Новый пароль</label>
						<div class="col-lg-9 col-xl-6">
							<input v-model="form.new_password" type="password" class="form-control">
						</div>
					</div>
          <div class="form-group row">
						<label class="col-xl-3 col-lg-3 col-form-label">Подтвердите пароль</label>
						<div class="col-lg-9 col-xl-6">
							<input v-model="form.new_password_confirmation" type="password" class="form-control">
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
        email: null,
        password: null,
        password_confirmation: null
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
    this.form.email = this.user.email
  }
}
</script>
