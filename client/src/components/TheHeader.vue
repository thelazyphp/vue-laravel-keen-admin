<template>
  <div id="kt_header" class="kt-header kt-grid__item kt-header--fixed">
    <div></div>
		<div class="kt-header__topbar">
			<div class="kt-header__topbar-item dropdown">
				<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px">
					<span class="kt-header__topbar-icon">
						<i class="flaticon2-bell-alarm-symbol"></i>
						<span class="kt-badge kt-badge--dot kt-badge--notify kt-badge--sm kt-badge--brand"></span>
					</span>
				</div>
				<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
					<form>
						<div class="kt-head" :style="{ backgroundImage: `url(${require('@/assets/media/misc/head_bg_sm.jpg')})` }">
							<h3 class="kt-head__title">Уведомления</h3>
							<div class="kt-head__sub">
                <span class="kt-head__desc">1 новое уведомление</span>
              </div>
						</div>
						<div class="kt-notification kt-margin-t-30 kt-margin-b-20 kt-scroll" data-scroll="true" data-height="270" data-mobile-height="220">
							<a href="" class="kt-notification__item">
								<div class="kt-notification__item-icon">
									<i class="flaticon2-line-chart kt-font-success"></i>
								</div>
								<div class="kt-notification__item-details">
									<div class="kt-notification__item-title">Цена на объект изменилась</div>
									<div class="kt-notification__item-time">2 часа назад</div>
								</div>
							</a>
						</div>
					</form>
				</div>
			</div>
			<div class="kt-header__topbar-item kt-header__topbar-item--user">
				<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
					<div class="kt-header__topbar-user kt-rounded-">
						<span class="kt-header__topbar-welcome kt-hidden-mobile">Привет,</span>
            <template v-if="$store.state.user">
              <span class="kt-header__topbar-username kt-hidden-mobile">{{ $store.state.user.f_name }}</span>
              <img src="@/assets/media/users/300_13.jpg" class="kt-rounded-" alt="">
            </template>
					</div>
				</div>
				<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-sm">
					<div v-if="$store.state.user" class="kt-user-card kt-margin-b-40 kt-margin-b-30-tablet-and-mobile" :style="{ backgroundImage: `url(${require('@/assets/media/misc/head_bg_sm.jpg')})` }">
						<div class="kt-user-card__wrapper">
							<div class="kt-user-card__pic">
								<img src="@/assets/media/users/300_13.jpg" class="kt-rounded-" alt="">
							</div>
							<div class="kt-user-card__details">
								<div class="kt-user-card__name">{{ $store.state.user.f_name }} {{ $store.state.user.l_name }}</div>
								<div v-if="$store.state.user.company" class="kt-user-card__position">{{ $store.state.user.company.name }}</div>
							</div>
						</div>
					</div>
					<ul class="kt-nav kt-margin-b-10">
						<li class="kt-nav__item">
							<router-link to="/profile" class="kt-nav__link">
								<span class="kt-nav__link-icon">
                  <i class="flaticon2-calendar-3"></i>
                </span>
								<span class="kt-nav__link-text">Профиль</span>
							</router-link>
						</li>
						<li class="kt-nav__separator kt-nav__separator--fit"></li>
						<li class="kt-nav__custom">
							<a href="" class="btn btn-label-brand btn-upper btn-sm btn-bold" @click.prevent="signOut">Выйти</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
  name: 'TheHeader',

  methods: {
    async signOut () {
      await this.$store.dispatch('auth/signOut')
      this.$router.push('/sign-in')
    }
  }
}
</script>
