<template>
	<div class="kt-grid kt-grid--ver kt-grid--root">
		<div id="kt_login_v2" class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid kt-grid--hor kt-login-v2">
			<div class="kt-grid__item kt-grid--hor">
				<div class="kt-login-v2__head">
					<div class="kt-login-v2__logo">
						<router-link :to="{ name: 'home' }">
							<img src="@/assets/media/logos/logo-5.png" alt="">
						</router-link>
					</div>
					<div class="kt-login-v2__signup">
						<span>Уже есть аккаунт?</span>
						<router-link :to="{ name: 'sign-in' }" class="kt-link kt-font-brand">Войти в аккаунт</router-link>
					</div>
				</div>
			</div>
			<div class="kt-grid__item kt-grid kt-grid--ver kt-grid__item--fluid">
				<div class="kt-login-v2__body">
					<div class="kt-login-v2__wrapper">
						<div class="kt-login-v2__container">
							<div class="kt-login-v2__title">
								<h3>Создать аккаунт</h3>
							</div>
							<form class="kt-login-v2__form kt-form" @submit.prevent="signUp">
                <div v-if="error" class="alert alert-danger" role="alert">
                  <div class="alert-icon">
                    <i class="flaticon-warning"></i>
                  </div>
                  <div class="alert-text">При создании аккаунта произошла ошибка!</div>
                </div>
                <div class="form-group">
									<input v-model="form.l_name" type="text" class="form-control" placeholder="Фамилия*" required autofocus autocomplete="family-name">
								</div>
                <div class="form-group">
									<input v-model="form.f_name" type="text" class="form-control" placeholder="Имя*" required autocomplete="given-name">
								</div>
                <div class="form-group">
									<input v-model="form.m_name" type="text" class="form-control" placeholder="Отчество" autocomplete="additional-name">
								</div>
                <div class="form-group">
									<input v-model="form.company_name" type="text" class="form-control" placeholder="Название организации">
								</div>
								<div class="form-group">
									<input v-model="form.email" type="email" class="form-control" placeholder="E-Mail*" required autocomplete="email">
								</div>
								<div class="form-group">
									<input v-model="form.password" type="password" class="form-control" placeholder="Пароль*" required autocomplete="new-password">
								</div>
                <div class="form-group">
									<input v-model="form.password_confirmation" type="password" class="form-control" placeholder="Подтвердите пароль*" required autocomplete="new-password" @paste.prevent>
								</div>
								<div class="kt-login-v2__actions">
									<button type="submit" class="btn btn-brand btn-elevate btn-pill">Создать</button>
								</div>
							</form>
						</div>
					</div>
					<div class="kt-login-v2__image">
						<img src="@/assets/media/misc/bg_icon.svg" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
require('@/assets/js/pages/custom/user/login.js')
import ApiService from '@/services/api.service.js'

export default {
  data () {
    return {
      error: false,
      form: {
        company_name: null,
        f_name: null,
        m_name: null,
        l_name: null,
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
  beforeMount () {
    document.body.setAttribute(
      'class',
      'kt-login-v2--enabled kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading'
    )
  },
  methods: {
    signUp () {
      this.error = false
      ApiService.signUp(this.form)
        .then(() => {
          const form = {
            username: this.form.email,
            password: this.form.password
          }

          this.$store.dispatch('auth/signIn', form)
            .then(() => this.$router.push({ name: 'user.profile' }))
        })
        .catch(() => this.error = true)
    }
  }
}
</script>

<style lang="scss" scoped>
@import '@/assets/sass/pages/login/login-v2.scss';
</style>
