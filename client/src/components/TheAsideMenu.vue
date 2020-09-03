<template>
  <div id="kt_aside_menu_wrapper" class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid">
    <div id="kt_aside_menu" class="kt-aside-menu" data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
      <ul class="kt-menu__nav">
        <li class="kt-menu__item" aria-haspopup="true">
          <a href="" class="kt-menu__link">
            <i class="kt-menu__link-icon flaticon2-gear"></i>
            <span class="kt-menu__link-text">Builder</span>
            <span class="kt-menu__link-badge">
              <span class="kt-badge kt-badge--brand">2</span>
            </span>
          </a>
        </li>
        <li class="kt-menu__section">
          <h4 class="kt-menu__section-text">Section</h4>
          <i class="kt-menu__section-icon flaticon-more-v2"></i>
        </li>
        <li class="kt-menu__item kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
          <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
            <i class="kt-menu__link-icon flaticon2-telegram-logo"></i>
            <span class="kt-menu__link-text">Apps</span>
            <i class="kt-menu__ver-arrow la la-angle-right"></i>
          </a>
          <div class="kt-menu__submenu">
            <span class="kt-menu__arrow"></span>
            <ul class="kt-menu__subnav">
              <li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true">
                <span class="kt-menu__link">
                  <span class="kt-menu__link-text">Apps</span>
                </span>
              </li>
              <li class="kt-menu__item" aria-haspopup="true">
                <a href="" class="kt-menu__link">
                  <i class="kt-menu__link-icon flaticon2-gear"></i>
                  <span class="kt-menu__link-text">Builder</span>
                  <span class="kt-menu__link-badge">
                    <span class="kt-badge kt-badge--brand">2</span>
                  </span>
                </a>
              </li>
              <li class="kt-menu__item" aria-haspopup="true">
                <a href="" class="kt-menu__link">
                  <i class="kt-menu__link-icon flaticon2-gear"></i>
                  <span class="kt-menu__link-text">Builder</span>
                  <span class="kt-menu__link-badge">
                    <span class="kt-badge kt-badge--brand">2</span>
                  </span>
                </a>
              </li>
              <li class="kt-menu__item" aria-haspopup="true">
                <a href="" class="kt-menu__link">
                  <i class="kt-menu__link-icon flaticon2-gear"></i>
                  <span class="kt-menu__link-text">Builder</span>
                  <span class="kt-menu__link-badge">
                    <span class="kt-badge kt-badge--brand">2</span>
                  </span>
                </a>
              </li>
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
