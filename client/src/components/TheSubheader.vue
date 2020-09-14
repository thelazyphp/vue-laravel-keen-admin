<template>
  <div id="kt_subheader" class="kt-subheader kt-grid__item">
    <div class="kt-container kt-container--fluid">
      <div class="kt-subheader__main">
		    <h3 class="kt-subheader__title">{{ title }}</h3>
	    </div>
    </div>
	</div>
</template>

<script>
export default {
  name: 'TheSubheader',
  props: {
    title: String
  }
}
</script>
