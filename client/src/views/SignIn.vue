<template>
	<div class="kt-grid kt-grid--ver kt-grid--root">
		<div id="kt_login_v2" class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid kt-grid--hor kt-login-v2">
			<div class="kt-grid__item kt-grid--hor">
				<div class="kt-login-v2__head">
					<div class="kt-login-v2__logo">
						<router-link to="/">
							<img src="@/assets/media/logos/logo-5.png" alt="">
						</router-link>
					</div>
					<div class="kt-login-v2__signup">
						<span>Нет аккаунта?</span>
						<router-link to="/sign-up" class="kt-link kt-font-brand">Создать аккаунт</router-link>
					</div>
				</div>
			</div>
			<div class="kt-grid__item kt-grid kt-grid--ver kt-grid__item--fluid">
				<div class="kt-login-v2__body">
					<div class="kt-login-v2__wrapper">
						<div class="kt-login-v2__container">
							<div class="kt-login-v2__title">
								<h3>Войти в аккаунт</h3>
							</div>
							<form class="kt-login-v2__form kt-form" @submit.prevent="signIn">
								<div class="form-group">
									<input v-model="form.username" type="email" class="form-control" placeholder="E-Mail" required autofocus autocomplete="email">
								</div>
								<div class="form-group">
									<input v-model="form.password" type="password" class="form-control" placeholder="Пароль" required autocomplete="cur-password">
								</div>
								<div class="kt-login-v2__actions">
									<button type="submit" class="btn btn-brand btn-elevate btn-pill">Войти</button>
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
export default {
  data () {
    return {
      loading: false,

      form: {
        username: null,
        password: null
      }
    }
  },

  mounted () {
    document.body.setAttribute('class', 'kt-login-v2--enabled kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading')
    require('@/assets/js/pages/custom/user/login.js')
  },

  methods: {
    async signIn () {
      this.loading = true

      try {
        await this.$store.dispatch('auth/signIn', this.form)
        this.$router.push('/')
      } catch (error) {
        //

        console.log(error)
      } finally {
        this.loading = false
      }
    }
  }
}
</script>

<style lang="scss" scoped>
@import '@/assets/sass/pages/login/login-v2.scss';
</style>
