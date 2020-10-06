<template>
  <div>
    <div
      id="filtersModal"
      class="modal fade"
      tabindex="-1"
      role="dialog"
      aria-labelledby="filtersModalLabel"
      aria-hidden="true"
    >
      <div
        class="modal-dialog"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header border-bottom-0">
            <h5
              id="filtersModalLabel"
              class="modal-title"
            >
              Фильтры
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Закрыть"
            >
              <i
                aria-hidden="true"
                class="ki ki-close"
              >
              </i>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent>
              <div class="form-group">
                <label for="role">Роль</label>
                <select
                  id="role"
                  v-model="filters.role"
                  class="form-control selectpicker"
                  multiple
                  data-none-selected-text="Любая"
                  data-actions-box="true"
                  data-select-all-text="Выбрать все"
                  data-deselect-all-text="Убрать все"
                >
                  <option value="admin">Администратор</option>
                  <option value="manager">Менеджер</option>
                  <option value="employee">Сотрудник</option>
                </select>
              </div>
            </form>
          </div>
          <div class="modal-footer border-top-0">
            <button
              type="button"
              class="btn btn-light-primary font-weight-bold"
              data-dismiss="modal"
              @click="resetFilters"
            >
              Сбросить
            </button>
            <button
              type="button"
              class="btn btn-primary font-weight-bold"
              data-dismiss="modal"
              @click="applyFilters"
            >
              Применить
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="card card-custom">
      <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
          <h3 class="card-label">
            Сотрудники
            <span class="text-muted pt-2 font-size-sm d-block">{{ userCompanyName }}</span>
          </h3>
        </div>
        <div class="card-toolbar">
          <router-link
            to="/employees/add"
            class="btn btn-light-primary font-weight-bolder mr-2"
            role="button"
          >
            Добавить
          </router-link>
          <button
            type="button"
            class="btn btn-primary font-weight-bolder"
            data-toggle="modal"
            data-target="#filtersModal"
          >
            <span class="svg-icon svg-icon-md">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                  <rect x="0" y="0" width="24" height="24"/>
                  <path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" fill="#000000"/>
                </g>
              </svg>
            </span>
            Фильтры
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="mb-7">
          <div class="row align-items-center">
            <div class="col-lg-4">
              <div class="input-icon">
                <input
                  id="search"
                  v-model="search"
                  type="text"
                  class="form-control form-control-solid"
                  placeholder="Поиск"
                >
                <span>
                  <i class="flaticon2-search-1 text-muted"></i>
                </span>
              </div>
            </div>
            <div class="col-lg-4 mt-5 mt-lg-0">
              <button
                type="button"
                class="btn btn-light-primary px-6 font-weight-bold"
                @click="applySearch"
              >
                Найти
              </button>
            </div>
          </div>
        </div>
        <div
          id="datatable"
          class="datatable datatable-bordered datatable-head-custom"
        >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      search: null,
      datatable: null
    }
  },

  computed: {
    /**
     * @returns {*}
     */
    defaultUserAvatar () {
      return require("../assets/media/users/blank.png")
    },

    /**
     * @returns {object}
     */
    user () {
      return this.$store.getters.user
    },

    /**
     * @returns {string}
     */
    userCompanyName () {
      return this.user.company ? this.user.company.name : ""
    },

    /**
     * @returns {boolean}
     */
    userIsAdmin () {
      return this.user.role === "admin"
    },

    /**
     * @returns {boolean}
     */
    userIsManager () {
      return this.user.role === "manager"
    },

    /**
     * @returns {boolean}
     */
    userIsEmployee () {
      return this.user.role === "employee"
    },

    /**
     * @returns {string}
     */
    token () {
      return this.$store.getters["auth/token"]
    },

    filters: {
      get () {
        return this.$store.getters["employees/filters"]
      },

      set (value) {
        this.$store.commit("employees/setFilters", value)
      }
    },

    /**
     * @returns {object}
     */
    datatableParams () {
      return this.$store.getters["employees/datatableParams"]
    }
  },

  beforeMount () {
    this.$store.commit("setPageTitle", "Сотрудники")
  },

  mounted () {
    this.datatable = window.$("#datatable").KTDatatable({
      data: {
        type: "remote",
        source: {
          read: {
            url: process.env.BASE_URL + "api/users",
            method: "GET",
            headers: {
              "authorization": "Bearer " + this.token
            },
            params: {
              params: this.datatableParams
            }
          }
        },
        saveState: false,
        serverPaging: true,
        serverSorting: true,
        serverFiltering: true
      },
      layout: {
        spinner: {
          message: "Загрузка..."
        }
      },
      sortable: true,
      pagination: true,
      search: {
        onEnter: true,
        key: 'search',
        input: window.$("#search")
      },
      toolbar: {
        items: {
          pagination: {
            navigation: {
              more: true
            }
          }
        }
      },
      translate: {
        records: {
          processing: "Пожалуйста, подождите...",
          noRecords: "Ни одной записи не найдено"
        },
        toolbar: {
          pagination: {
            items: {
              default: {
                first: "Первая",
                prev: "Предыдущая",
                next: "Следующая",
                last: "Последняя",
                more: "Еще страницы",
                input: "Номер страницы",
                select: "Записей на страницу"
              },
              info: "Отображено {{start}} - {{end}} из {{total}} записей"
            }
          }
        }
      },
      columns: [
        {
          field: "avatar",
          title: "Аватар",
          width: 100,
          sortable: false,
          autoHide: false,

          template (row) {
            return `<div style="display: inline-block; width: 64px; height: 64px; border-radius: 50%; background-image: url(` + (row.image ? row.image.url : this.defaultUserAvatar) + `); background-size: cover; background-repeat: no-repeat; background-position: center center"></div>`
          }
        },
        {
          field: "first_name",
          title: "Имя",
          sortable: true,
          width: 100,
          autoHide: false
        },
        {
          field: "last_name",
          title: "Фамилия",
          sortable: true,
          width: 100,
          autoHide: false
        },
        {
          field: "email",
          title: "E-Mail",
          sortable: true,
          width: 200,
          autoHide: true
        },
        {
          field: "contact_phone",
          title: "Тел.",
          sortable: true,
          width: 200,
          autoHide: true
        },
        {
          field: "role",
          title: "Роль",
          sortable: true,
          width: 100,
          autoHide: true,

          template (row) {
            const roles = {
              admin: {
                color: "danger",
                text: "Админ"
              },
              manager: {
                color: "success",
                text: "Менеджер"
              },
              employee: {
                color: "primary",
                text: "Сотрудник"
              }
            }

            return `<span class="label font-weight-bold label-lg label-light-` + roles[row.role].color + ` label-inline">` + roles[row.role].text + `</span>`
          }
        }
      ]
    })
  },

  methods: {
    /**
     * Searches employees.
     */
    applySearch () {
      this.datatable.setDataSourceParam("query", {
        search: this.search
      })

      this.datatable.load()
    },

    /**
     * Filters employees.
     */
    applyFilters () {
      this.datatable.setDataSourceParam("params", this.datatableParams)
      this.datatable.load()
    },

    /**
     * Resets filters to the initial state.
     */
    resetFilters () {
      window.$("#role").val("default").selectpicker("refresh")
      this.$store.commit("employees/resetFilters")
      this.datatable.setDataSourceParam("params", {})
      this.datatable.load()
    }
  }
}
</script>
