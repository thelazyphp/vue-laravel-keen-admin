<template>
  <div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row-fluid flex-column bgi-size-cover bgi-position-center bgi-no-repeat p-10 p-sm-30" :style="{ backgroundImage: `url(${backgroundImage})` }">
      <h1 class="font-weight-boldest text-dark-75 mt-15" style="font-size: 10rem">404</h1>
      <p class="font-size-h3 text-muted font-weight-normal">ОЙ! Что-то пошло не так</p>
    </div>
  </div>
</template>

<script>
import { mapMutations } from 'vuex'
import {
  SET_PAGE_TITLE
} from '../store'

export default {
  computed: {
    backgroundImage () {
      return require('../assets/media/error/bg1.jpg')
    }
  },
  beforeMount () {
    this[SET_PAGE_TITLE]('Ошибка')
  },
  methods: {
    ...mapMutations([
      SET_PAGE_TITLE
    ])
  }
}
</script>
