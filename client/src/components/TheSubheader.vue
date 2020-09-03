<template>
  <div id="kt_subheader" class="kt-subheader kt-grid__item">
		<div class="kt-container kt-container--fluid">
			<div class="kt-subheader__main">
				<h3 class="kt-subheader__title">
          <slot>{{ title }}</slot>
        </h3>
				<span class="kt-subheader__separator kt-hidden"></span>
				<div class="kt-subheader__breadcrumbs">
					<router-link to="/" class="kt-subheader__breadcrumbs-home">
            <i class="flaticon2-shelter"></i>
          </router-link>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<router-link to="/" class="kt-subheader__breadcrumbs-link">Link 1</router-link>
					<span class="kt-subheader__breadcrumbs-separator"></span>
					<router-link to="/" class="kt-subheader__breadcrumbs-link">Link 2</router-link>
					<span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Link 3</span>
				</div>
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
