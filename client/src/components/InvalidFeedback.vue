<template>
  <div class="invalid-feedback">
    <ul class="list-unstyled">
      <li
        v-for="(error, index) in errors"
        :key="index"
      >
        {{ error }}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'InvalidFeedback',

  props: {
    errors: {
      type: Array,

      default () {
        return []
      }
    }
  }
}
</script>
