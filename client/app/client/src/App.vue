<template>
  <router-view/>
</template>

<script>
export default {
  beforeMount () {
    document.body.id = "kt_body"
    document.body.className = "header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable"
  }
}
</script>

<style lang="scss">
@import "~perfect-scrollbar/css/perfect-scrollbar.css";
@import "assets/plugins/keenthemes-icons/font/ki.css";
@import "~apexcharts/dist/apexcharts.css";
@import "assets/plugins/formvalidation/dist/css/formValidation.css";
@import "~bootstrap-datepicker/dist/css/bootstrap-datepicker3.css";
@import "~bootstrap-timepicker/css/bootstrap-timepicker.css";
@import "~bootstrap-daterangepicker/daterangepicker.css";
@import "~bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css";
@import "~bootstrap-select/dist/css/bootstrap-select.css";
@import "~bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css";
@import "~select2/dist/css/select2.css";
@import "~ion-rangeslider/css/ion.rangeSlider.css";
@import "~nouislider/distribute/nouislider.css";
@import "~owl.carousel/dist/assets/owl.carousel.css";
@import "~owl.carousel/dist/assets/owl.theme.default.css";
@import "~dropzone/dist/dropzone.css";
@import "~quill/dist/quill.snow.css";
@import "~@yaireo/tagify/src/tagify.scss";
@import "~summernote/dist/summernote.css";
@import "~bootstrap-markdown/css/bootstrap-markdown.min.css";
@import "~animate.css/animate.css";
@import "~toastr/build/toastr.css";
@import "~dual-listbox/dist/dual-listbox.css";
@import "~sweetalert2/dist/sweetalert2.css";
@import "~line-awesome/dist/line-awesome/css/line-awesome.css";
@import "assets/plugins/flaticon/flaticon.css";
@import "assets/plugins/flaticon2/flaticon.css";
@import "~socicon/css/socicon.css";
@import "~@fortawesome/fontawesome-free/css/all.min.css";
@import "assets/sass/style.scss";
@import "assets/sass/themes/layout/header/base/light.scss";
@import "assets/sass/themes/layout/header/menu/light.scss";
@import "assets/sass/themes/layout/brand/dark.scss";
@import "assets/sass/themes/layout/aside/dark.scss";
</style>
