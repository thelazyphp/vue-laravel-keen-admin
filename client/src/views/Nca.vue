<template>
  <div class="card card-custom">
    <div class="card-body">
      <div class="form-group row">
				<label class="col-form-label col-lg-3 col-sm-12 text-lg-right">Обновить базу</label>
				<div class="col-lg-4 col-md-9 col-sm-12">
					<div
            id="dropzone"
            class="dropzone dropzone-default dropzone-primary"
          >
						<div class="dropzone-msg dz-message needsclick">
							<h3 class="dropzone-msg-title">Перетащите сюда файл</h3>
						</div>
					</div>
				</div>
			</div>
    </div>
  </div>
</template>

<script>
export default {
  mounted () {
    window.$('#dropzone').dropzone({
      url: '',
      maxFiles: 1,
      paramName: 'file'
    })
  }
}
</script>
