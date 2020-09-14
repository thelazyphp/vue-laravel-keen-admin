<template>
  <div class="kt-portlet kt-portlet--tabs">
		<div class="kt-portlet__head">
			<div class="kt-portlet__head-toolbar">
			  <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand">
			  	<li class="nav-item">
			  		<router-link :to="{ name: 'user.profile' }" class="nav-link" active-class="active" exact-active-class="active">
			  			<i class="flaticon2-calendar-3"></i> Профиль
			  		</router-link>
			  	</li>
			  	<li class="nav-item">
			  		<router-link :to="{ name: 'user.account' }" class="nav-link" active-class="active" exact-active-class="active">
			  			<i class="flaticon2-protected"></i> Аккаунт
			  		</router-link>
			  	</li>
			  	<li class="nav-item">
			  		<router-link :to="{ name: 'user.company' }" class="nav-link" active-class="active" exact-active-class="active">
			  			<i class="flaticon2-architecture-and-city"></i> Организация
			  		</router-link>
			  	</li>
			  </ul>
			</div>
		</div>
		<div class="kt-portlet__body">
			<div class="tab-content kt-margin-t-20 kt-margin-b-20">
				<router-view />
			</div>
		</div>
  </div>
</template>
