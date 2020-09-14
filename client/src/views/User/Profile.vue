<template>
  <form class="kt-form kt-form--label-right" @submit.prevent>
    <div class="kt-form__body">
			<div class="kt-section kt-section--first">
			  <div class="kt-section__body">
					<div class="form-group row">
						<label class="col-xl-3 col-lg-3 col-form-label">Аватар</label>
						<div class="col-lg-9 col-xl-6">
							<div id="kt_user_avatar" class="kt-avatar kt-avatar--outline kt-avatar--circle-">
								<div class="kt-avatar__holder" :style="{ backgroundImage: `url(${require('@/assets/media/users/300_13.jpg')})` }"></div>
								<label class="kt-avatar__upload" title="" data-toggle="kt-tooltip" data-original-title="Изменить аватар">
									<i class="fa fa-pen"></i>
									<input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
								</label>
								<span class="kt-avatar__cancel" title="" data-toggle="kt-tooltip" data-original-title="Удалить аватар">
									<i class="fa fa-times"></i>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-xl-3 col-lg-3 col-form-label">Фамилия</label>
						<div class="col-lg-9 col-xl-6">
							<input v-model="form.l_name" type="text" class="form-control">
						</div>
					</div>
          <div class="form-group row">
						<label class="col-xl-3 col-lg-3 col-form-label">Имя</label>
						<div class="col-lg-9 col-xl-6">
							<input v-model="form.f_name" type="text" class="form-control">
						</div>
					</div>
          <div class="form-group row">
						<label class="col-xl-3 col-lg-3 col-form-label">Отчество</label>
						<div class="col-lg-9 col-xl-6">
							<input v-model="form.m_name" type="text" class="form-control">
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
						<label class="col-xl-3 col-lg-3 col-form-label">О себе</label>
						<div class="col-lg-9 col-xl-6">
							<textarea v-model="form.about" type="text" class="form-control" rows="3"></textarea>
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
        phone: null,
        about: null,
        f_name: null,
        m_name: null,
        l_name: null
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
    this.form.phone = this.user.phone
    this.form.about = this.user.about
    this.form.f_name = this.user.f_name
    this.form.m_name = this.user.m_name
    this.form.l_name = this.user.l_name
  }
}
</script>
