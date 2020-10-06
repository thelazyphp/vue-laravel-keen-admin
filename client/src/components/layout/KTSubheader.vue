<template>
  <div
    id="kt_subheader"
    class="subheader py-2 py-lg-4 subheader-solid"
  >
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
      <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ pageTitle }}</h5>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "KTSubheader",

  props: {
    pageTitle: String
  },

  mounted () {
    this.$nextTick(() => {
      window.KTLayoutSubheader.init("kt_subheader")
    })
  }
}
</script>
