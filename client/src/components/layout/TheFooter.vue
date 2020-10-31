<template>
  <div
    id="kt_footer"
    class="footer bg-white py-4 d-flex flex-lg-column"
  >
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
      <div class="text-dark order-2 order-md-1">
        <span class="text-muted font-weight-bold mr-2">&copy; {{ year }}</span>
        <router-link
          to="/"
          class="text-dark-75 text-hover-primary"
        >
          {{ appName }}
        </router-link>
      </div>
      <div class="nav nav-dark order-1 order-md-2">
        <a
          href=""
          class="nav-link pr-3 pl-0"
        >
          Документация
        </a>
        <a
          href=""
          class="nav-link px-3"
        >
          Разработчикам
        </a>
        <a
          href=""
          class="nav-link pl-3 pr-0"
        >
          Связаться с нами
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'TheFooter',

  computed: {
    /**
     * @returns {string}
     */
    appName () {
      return 'Realty'
    },

    /**
     * @returns {number}
     */
    year () {
      return new Date().getFullYear()
    }
  }
}
</script>
