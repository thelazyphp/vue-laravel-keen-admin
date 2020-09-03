<template>
	<div class="kt-grid kt-grid--ver kt-grid--root">
		<div class="kt-grid__item   kt-grid__item--fluid kt-grid  kt-grid kt-grid--hor kt-login-v2" id="kt_login_v2">
			<div class="kt-grid__item  kt-grid--hor">
				<div class="kt-login-v2__head">
					<div class="kt-login-v2__logo">
						<a href="#">
							<img src="@/assets/media/logos/logo-5.png" alt="" />
						</a>
					</div>
					<div class="kt-login-v2__signup">
						<span>Don't have an account?</span>
						<a href="#" class="kt-link kt-font-brand">Sign Up</a>
					</div>
				</div>
			</div>
			<div class="kt-grid__item  kt-grid  kt-grid--ver  kt-grid__item--fluid">
				<div class="kt-login-v2__body">
					<div class="kt-login-v2__wrapper">
						<div class="kt-login-v2__container">
							<div class="kt-login-v2__title">
								<h3>Sign to Account</h3>
							</div>
							<form class="kt-login-v2__form kt-form" action="" autocomplete="off">
								<div class="form-group">
									<input class="form-control" type="text" placeholder="Username" name="username" autocomplete="off">
								</div>
								<div class="form-group">
									<input class="form-control" type="password" placeholder="Password" name="password" autocomplete="off">
								</div>
								<div class="kt-login-v2__actions">
									<a href="#" class="kt-link kt-link--brand">
										Forgot Password ?
									</a>
									<button type="submit" class="btn btn-brand btn-elevate btn-pill">Sign In</button>
								</div>
							</form>
							<div class="kt-separator kt-separator--space-lg  kt-separator--border-solid"></div>
							<h3 class="kt-login-v2__desc">Or sign with social account</h3>
							<div class="kt-login-v2__options">
								<a href="#" class="btn btn-facebook btn-pill">
									<i class="fab fa-facebook-f"></i>
									Facebook
								</a>
								<a href="#" class="btn btn-twitter btn-pill">
									<i class="fab fa-twitter"></i>
									Twitter
								</a>
								<a href="#" class="btn btn-google btn-pill">
									<i class="fab fa-google"></i>
									Google
								</a>
							</div>
						</div>
					</div>
					<div class="kt-login-v2__image">
						<img src="@/assets/media/misc/bg_icon.svg" alt="">
					</div>
				</div>
			</div>
			<div class="kt-grid__item">
				<div class="kt-login-v2__footer">
					<div class="kt-login-v2__link">
						<a href="#" class="kt-link kt-font-brand">Privacy</a>
						<a href="#" class="kt-link kt-font-brand">Legal</a>
						<a href="#" class="kt-link kt-font-brand">Contact</a>
					</div>
					<div class="kt-login-v2__info">
						<a href="#" class="kt-link">&copy; 2018 KeenThemes</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
  mounted () {
    document.body.setAttribute('class', 'kt-login-v2--enabled kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading')
    require('@/assets/js/pages/custom/user/login.js')
  }
}
</script>

<style lang="scss" scoped>
@import '@/assets/sass/pages/login/login-v2.scss';
</style>
