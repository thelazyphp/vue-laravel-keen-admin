<template>
  <div class="kt-portlet kt-portlet--tabs">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-toolbar">
			  <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand" role="tablist">
			  	<li class="nav-item">
			  		<a href="#kt_users_edit_tab_1" class="nav-link active" data-toggle="tab" role="tab">
			  			<i class="flaticon2-calendar-3"></i> Профиль
			  		</a>
			  	</li>
			  	<li class="nav-item">
			  		<a href="#kt_users_edit_tab_2" class="nav-link" data-toggle="tab" role="tab">
			  			<i class="flaticon2-protected"></i> Аккаунт
			  		</a>
			  	</li>
			  	<li class="nav-item">
			  		<a href="#kt_users_edit_tab_3" class="nav-link" data-toggle="tab" role="tab">
			  			<i class="flaticon2-architecture-and-city"></i> Организация
			  		</a>
			  	</li>
			  </ul>
			</div>
		</div>
		<div class="kt-portlet__body">
			<div class="tab-content kt-margin-t-20 kt-margin-b-20">
				<div id="kt_users_edit_tab_1" class="tab-pane active" role="tabpanel">
					<div class="kt-form kt-form--label-right">
						<div class="kt-form__body">
							<div class="kt-section kt-section--first">
							  <div class="kt-section__body">
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Аватар</label>
										<div class="col-lg-9 col-xl-6">
											<div id="kt_user_avatar" class="kt-avatar kt-avatar--outline kt-avatar--circle-">
												<div class="kt-avatar__holder" :style="{ backgroundImage: `url(${require('@/assets/media/users/300_13.jpg')})` }"></div>
												<label class="kt-avatar__upload" title="" data-toggle="kt-tooltip" data-original-title="Изменить аватар">
													<i class="fa fa-pen"></i>
													<input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg">
												</label>
												<span class="kt-avatar__cancel" title="" data-toggle="kt-tooltip" data-original-title="Удалить аватар">
													<i class="fa fa-times"></i>
												</span>
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Фамилия</label>
										<div class="col-lg-9 col-xl-6">
											<input v-model="form.l_name" type="text" class="form-control">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Имя</label>
										<div class="col-lg-9 col-xl-6">
											<input v-model="form.f_name" type="text" class="form-control">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Отчество</label>
										<div class="col-lg-9 col-xl-6">
											<input v-model="form.m_name" type="text" class="form-control">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Номер телефона</label>
										<div class="col-lg-9 col-xl-6">
											<div class="input-group">
												<div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="la la-phone"></i>
                          </span>
                        </div>
												<input v-model="form.phone" type="text" class="form-control">
											</div>
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">О себе</label>
										<div class="col-lg-9 col-xl-6">
											<textarea v-model="form.about" type="text" class="form-control" rows="3"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
            <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
            <div class="kt-form__actions">
              <div class="row">
                <div class="col-xl-3"></div>
                <div class="col-lg-9 col-xl-6">
                  <button type="submit" class="btn btn-label-brand btn-bold">Сохранить</button>
                </div>
              </div>
            </div>
					</div>
				</div>
        <div id="kt_users_edit_tab_2" class="tab-pane" role="tabpanel">
					<div class="kt-form kt-form--label-right">
						<div class="kt-form__body">
							<div class="kt-section kt-section--first">
							  <div class="kt-section__body">
                  <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">E-Mail</label>
										<div class="col-lg-9 col-xl-6">
											<div class="input-group">
												<div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="la la-at"></i>
                          </span>
                        </div>
												<input v-model="form.email" type="email" class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Текущий пароль</label>
										<div class="col-lg-9 col-xl-6">
											<input v-model="form.cur_password" type="password" class="form-control">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Новый пароль</label>
										<div class="col-lg-9 col-xl-6">
											<input v-model="form.new_password" type="password" class="form-control">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Подтвердите пароль</label>
										<div class="col-lg-9 col-xl-6">
											<input v-model="form.new_password_confirmation" type="password" class="form-control">
										</div>
									</div>
								</div>
							</div>
						</div>
            <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
            <div class="kt-form__actions">
              <div class="row">
                <div class="col-xl-3"></div>
                <div class="col-lg-9 col-xl-6">
                  <button type="submit" class="btn btn-label-brand btn-bold">Сохранить</button>
                </div>
              </div>
            </div>
					</div>
				</div>
        <div id="kt_users_edit_tab_3" class="tab-pane" role="tabpanel">
					<div class="kt-form kt-form--label-right">
						<div class="kt-form__body">
							<div class="kt-section kt-section--first">
							  <div class="kt-section__body">
                  <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Название</label>
										<div class="col-lg-9 col-xl-6">
											<input v-model="form.company.name" type="text" class="form-control">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Сайт</label>
										<div class="col-lg-9 col-xl-6">
											<div class="input-group">
												<input v-model="form.company.website" type="url" class="form-control">
                        <div class="input-group-append">
                          <span class="input-group-text">.com</span>
                        </div>
											</div>
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">E-Mail</label>
										<div class="col-lg-9 col-xl-6">
											<div class="input-group">
												<div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="la la-at"></i>
                          </span>
                        </div>
												<input v-model="form.company.email" type="email" class="form-control">
											</div>
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Номер телефона</label>
										<div class="col-lg-9 col-xl-6">
											<div class="input-group">
												<div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="la la-phone"></i>
                          </span>
                        </div>
												<input v-model="form.company.phone" type="text" class="form-control">
											</div>
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">УНП</label>
										<div class="col-lg-9 col-xl-6">
											<input v-model="form.company.licence" type="text" class="form-control">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Адрес</label>
										<div class="col-lg-9 col-xl-6">
											<input v-model="form.company.address" type="text" class="form-control">
										</div>
									</div>
                  <div class="form-group row">
										<label class="col-xl-3 col-lg-3 col-form-label">Описание</label>
										<div class="col-lg-9 col-xl-6">
											<textarea v-model="form.company.description" class="form-control" rows="3"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
            <div class="kt-separator kt-separator--space-lg kt-separator--fit kt-separator--border-solid"></div>
            <div class="kt-form__actions">
              <div class="row">
                <div class="col-xl-3"></div>
                <div class="col-lg-9 col-xl-6">
                  <button type="submit" class="btn btn-label-brand btn-bold">Сохранить</button>
                </div>
              </div>
            </div>
					</div>
				</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      form: {
        company: {
          name: null,
          website: null,
          email: null,
          phone: null,
          licence: null,
          address: null,
          description: null
        },

        phone: null,
        about: null,
        email: null,
        f_name: null,
        m_name: null,
        l_name: null,
        cur_password: null,
        new_password: null,
        new_password_confirmation: null
      }
    }
  },

  computed: {
    user () {
      return this.$store.state.user
    }
  },

  created () {
    this.form.phone = this.user.phone
    this.form.about = this.user.about
    this.form.email = this.user.email
    this.form.f_name = this.user.f_name
    this.form.m_name = this.user.m_name
    this.form.l_name = this.user.l_name

    if (this.user.company) {
      this.form.company.name = this.user.company.name
      this.form.company.website = this.user.company.website
      this.form.company.email = this.user.company.email
      this.form.company.phone = this.user.company.phone
      this.form.company.licence = this.user.company.licence
      this.form.company.address = this.user.company.address
      this.form.company.description = this.user.company.description
    }
  },

  mounted () {
    require('@/assets/js/pages/custom/users/edit.js')
  }
}
</script>
