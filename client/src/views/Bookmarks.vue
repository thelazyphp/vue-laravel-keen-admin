<template>
  <div>
    <!-- -->
  </div>
</template>

<script>
import { mapMutations } from "vuex"
import {
  SET_PAGE_TITLE
} from "../store"

export default {
  beforeMount () {
    this[SET_PAGE_TITLE]("Закладки")
  },
  methods: {
    ...mapMutations([
      SET_PAGE_TITLE
    ])
  }
}
</script>
