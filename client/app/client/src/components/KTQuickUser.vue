<template>
  <div
    id="kt_quick_user"
    class="offcanvas offcanvas-right p-10"
  >
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
      <h3 class="font-weight-bold m-0">Профиль</h3>
      <KTQuickUserClose/>
    </div>
    <div class="offcanvas-content pr-5 mr-n5">
      <div class="d-flex align-items-center mt-5">
        <div class="symbol symbol-100 mr-5">
          <div
            class="symbol-label"
            :style="{
              backgroundImage: `url(${userAvatar})`
            }"
          >
          </div>
          <i class="symbol-badge bg-success"></i>
        </div>
        <div class="d-flex flex-column">
          <a
            href=""
            class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"
          >
            {{ user.f_name }} {{ user.l_name }}
          </a>
          <div class="text-muted mt-1">{{ userRole }}</div>
          <div class="navi mt-2">
            <button
              type="button"
              class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5"
              @click="logout"
            >
              Выйти
            </button>
          </div>
        </div>
      </div>
      <div class="separator separator-dashed mt-8 mb-5"></div>
      <div class="navi navi-spacer-x-0 p-0">
        <a
          href=""
          class="navi-item"
        >
          <div class="navi-link">
            <div class="symbol symbol-40 bg-light mr-3">
              <div class="symbol-label">
                <span class="svg-icon svg-icon-md svg-icon-success">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <rect x="0" y="0" width="24" height="24"/>
                      <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000"/>
                      <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5"/>
                    </g>
                  </svg>
                </span>
              </div>
            </div>
            <div class="navi-text">
              <div class="font-weight-bold">Мой профиль</div>
              <div class="text-muted">Настроить мой профиль</div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex"
import {
  LOGOUT
} from "../store/auth.module.js"
import KTQuickUserClose from "./KTQuickUserClose.vue"

export default {
  name: "KTQuickUser",
  components: {
    KTQuickUserClose
  },
  computed: {
    ...mapGetters([
      "user"
    ]),
    userAvatar () {
      return require("../assets/media/users/300_21.jpg")
    },
    userRole () {
      let role = ""

      switch (this.user.role) {
        case "admin":
          role = "Администратор"
          break
        case "manager":
          role = "Менеджер"
          break
        case "employee":
          role = "Сотрудник"
          break
      }

      return role
    }
  },
  mounted () {
    this.$nextTick(() => {
      window.KTLayoutQuickUser.init("kt_quick_user")
    })
  },
  methods: {
    ...mapActions([
      "auth/" + LOGOUT
    ]),
    logout () {
      this["auth/" + LOGOUT]()
        .then(() => {
          this.$router.push({
            name: "login"
          })
        })
    }
  }
}
</script>
