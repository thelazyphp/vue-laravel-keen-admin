<template>
  <div id="kt_aside_menu_wrapper" class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid">
    <div id="kt_aside_menu" class="kt-aside-menu" data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
      <ul class="kt-menu__nav">
        <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
          <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
            <i class="kt-menu__link-icon flaticon2-open-box"></i>
            <span class="kt-menu__link-text">Объявления</span>
            <i class="kt-menu__ver-arrow la la-angle-right"></i>
          </a>
					<div class="kt-menu__submenu">
            <span class="kt-menu__arrow"></span>
						<ul class="kt-menu__subnav">
							<li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true">
                <span class="kt-menu__link">
                  <span class="kt-menu__link-text">Объявления</span>
                </span>
              </li>
							<router-link :to="{ name: 'ads.apartments' }" class="kt-menu__item" tag="li" active-class="kt-menu__item--active" exact-active-class="kt-menu__item--active" aria-haspopup="true">
                <a href="" class="kt-menu__link">
                  <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="kt-menu__link-text">Квартиры</span>
                </a>
              </router-link>
              <router-link :to="{ name: 'ads.houses' }" class="kt-menu__item" tag="li" active-class="kt-menu__item--active" exact-active-class="kt-menu__item--active" aria-haspopup="true">
                <a href="" class="kt-menu__link">
                  <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="kt-menu__link-text">Земельная</span>
                </a>
              </router-link>
              <router-link :to="{ name: 'ads.commercial-real-estate' }" class="kt-menu__item" tag="li" active-class="kt-menu__item--active" exact-active-class="kt-menu__item--active" aria-haspopup="true">
                <a href="" class="kt-menu__link">
                  <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
                    <span></span>
                  </i>
                  <span class="kt-menu__link-text">Коммерческая</span>
                </a>
              </router-link>
						</ul>
					</div>
				</li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TheAsideMenu'
}
</script>
