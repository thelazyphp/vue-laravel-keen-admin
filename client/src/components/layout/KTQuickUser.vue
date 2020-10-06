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
            {{ user.first_name }} {{ user.last_name }}
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
        <router-link
          to="/profile"
          class="navi-item"
          @click.native="closeOffcanvas"
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
        </router-link>
        <router-link
          to="/company"
          class="navi-item"
          @click.native="closeOffcanvas"
        >
          <div class="navi-link">
            <div class="symbol symbol-40 bg-light mr-3">
              <div class="symbol-label">
                <span class="svg-icon svg-icon-md svg-icon-success">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <path d="M20,8 L18.173913,8 C17.0693435,8 16.173913,8.8954305 16.173913,10 L16.173913,12 C16.173913,12.5522847 15.7261978,13 15.173913,13 L8.86956522,13 C8.31728047,13 7.86956522,12.5522847 7.86956522,12 L7.86956522,10 C7.86956522,8.8954305 6.97413472,8 5.86956522,8 L4,8 L4,6 C4,4.34314575 5.34314575,3 7,3 L17,3 C18.6568542,3 20,4.34314575 20,6 L20,8 Z" fill="#000000" opacity="0.3"/>
                      <path d="M6.15999985,21.0604779 L8.15999985,17.5963763 C8.43614222,17.1180837 9.04773263,16.9542085 9.52602525,17.2303509 C10.0043179,17.5064933 10.168193,18.1180837 9.89205065,18.5963763 L7.89205065,22.0604779 C7.61590828,22.5387706 7.00431787,22.7026457 6.52602525,22.4265033 C6.04773263,22.150361 5.88385747,21.5387706 6.15999985,21.0604779 Z M17.8320512,21.0301278 C18.1081936,21.5084204 17.9443184,22.1200108 17.4660258,22.3961532 C16.9877332,22.6722956 16.3761428,22.5084204 16.1000004,22.0301278 L14.1000004,18.5660262 C13.823858,18.0877335 13.9877332,17.4761431 14.4660258,17.2000008 C14.9443184,16.9238584 15.5559088,17.0877335 15.8320512,17.5660262 L17.8320512,21.0301278 Z" fill="#000000" opacity="0.3"/>
                      <path d="M20,10 L20,15 C20,16.6568542 18.6568542,18 17,18 L7,18 C5.34314575,18 4,16.6568542 4,15 L4,10 L5.86956522,10 L5.86956522,12 C5.86956522,13.6568542 7.21271097,15 8.86956522,15 L15.173913,15 C16.8307673,15 18.173913,13.6568542 18.173913,12 L18.173913,10 L20,10 Z" fill="#000000"/>
                    </g>
                  </svg>
                </span>
              </div>
            </div>
            <div class="navi-text">
              <div class="font-weight-bold">Моя организация</div>
              <div class="text-muted">Настроить мою организацию</div>
            </div>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import KTQuickUserClose from "./KTQuickUserClose.vue"

export default {
  name: "KTQuickUser",

  components: {
    KTQuickUserClose
  },

  computed: {
    /**
     * @returns {object}
     */
    user () {
      return this.$store.getters.user
    },

    /**
     * @returns {*}
     */
    defaultUserAvatar () {
      return require("../../assets/media/users/blank.png")
    },

    /**
     * @returns {(*|string)}
     */
    userAvatar () {
      return this.user.image ? this.user.image.url : this.defaultUserAvatar
    },

    /**
     * @returns {string}
     */
    userRole () {
      const roles = {
        admin: "Админ",
        manager: "Менеджер",
        employee: "Сотрудник"
      }

      return roles[this.user.role]
    }
  },

  mounted () {
    this.$nextTick(() => {
      window.KTLayoutQuickUser.init("kt_quick_user")
    })
  },

  methods: {
    /**
     * Logs the user out.
     */
    logout () {
      this.$store.dispatch("auth/logout")
        .then(() => {
          this.$router.push({
            name: "login"
          })
        })
    },

    /**
     * Closes the offcanvas menu.
     */
    closeOffcanvas () {
      document.getElementById("kt_quick_user_close").click()
    }
  }
}
</script>
