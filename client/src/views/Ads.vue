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
        class="modal-dialog modal-dialog-scrollable"
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
            <FiltersForm
              v-model="filters"
              :options="filterOptions"
            />
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
    <div
      id="mapModal"
      class="modal fade"
      tabindex="-1"
      role="dialog"
      aria-labelledby="mapModalLabel"
      aria-hidden="true"
    >
      <div
        class="modal-dialog"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header border-bottom-0">
            <h5
              id="mapModalLabel"
              class="modal-title"
            >
              Посмотреть на карте
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
            <p>{{ mapModalAddress }}</p>
            <div id="map" style="height: 500px"></div>
          </div>
          <div class="modal-footer border-top-0">
            <button
              type="button"
              class="btn btn-light-primary font-weight-bold"
              data-dismiss="modal"
            >
              Закрыть
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="card card-custom">
      <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
          <h3 class="card-label">
            Квартиры
            <span class="text-muted pt-2 font-size-sm d-block">Объявления об аренде и продаже квартир</span>
          </h3>
        </div>
        <div class="card-toolbar">
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
import FiltersForm from "../components/FiltersForm.vue"

export default {
  components: {
    FiltersForm
  },

  data () {
    return {
      mapModalAddress: "",
      map: null,
      search: null,
      datatable: null
    }
  },

  computed: {
    /**
     * @returns {string}
     */
    token () {
      return this.$store.getters["auth/token"]
    },

    filters: {
      get () {
        return this.$store.getters["ads/filters"]
      },

      set (value) {
        this.$store.commit("ads/setFilters", value)
      }
    },

    /**
     * @returns {object}
     */
    filterOptions () {
      return require("../data/filter.options.json")
    },

    /**
     * @returns {object}
     */
    datatableParams () {
      return this.$store.getters["ads/datatableParams"]
    }
  },

  beforeMount () {
    this.$store.commit("setPageTitle", "Объявления")
  },

  mounted () {
    window.ymaps.ready(() => {
      this.map = new window.ymaps.Map("map", {
        center: [53.882845, 27.727359],
        zoom: 7
      })
    })

    window.$("#mapModal").on("show.bs.modal", (event) => {
      const toggle = window.$(event.relatedTarget)
      const lat = toggle.data("lat")
      const long = toggle.data("long")
      const address = toggle.data("address")
      const placemark = new window.ymaps.Placemark([lat, long])
      this.mapModalAddress = address
      this.map.setCenter([lat, long], 18)
      this.map.geoObjects.removeAll()
      this.map.geoObjects.add(placemark)
    })

    this.datatable = window.$("#datatable").KTDatatable({
      data: {
        type: "remote",
        source: {
          read: {
            url: process.env.BASE_URL + "api/ads",
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
          field: "id",
          title: "#",
          sortable: true,
          width: 50,
          autoHide: true
        },
        {
          field: "image",
          title: "Фото",
          sortable: false,
          width: 100,
          autoHide: true,

          template (row) {
            let image = ""

            if (row.images.length) {
              image = `\
                <a href="` + row.images[0].src + `" target="_blank" title="Открыть фото">\
                  <div class="rounded" style="display: inline-block; width: 64px; height: 64px; background-image: url(` + (row.images[0].thumb || row.images[0].src) + `); background-size: cover; background-repeat: no-repeat; background-position: center center"></div>\
                </a>`
            } else {
              image = `<div class="rounded" style="display: inline-block; width: 64px; height: 64px; background-image: url(` + require("@/assets/image-default.jpg") + `); background-size: cover; background-repeat: no-repeat; background-position: center center"></div>`
            }

            return image
          }
        },
        {
          field: "published_at",
          title: "Дата",
          sortable: true,
          width: 100,
          autoHide: true,

          template (row) {
            return new Date(row.published_at).toLocaleDateString()
          }
        },
        {
          field: "full_address",
          title: "Адрес",
          sortable: true,
          width: 100,
          autoHide: true,

          template (row) {
            return row.full_address ? row.full_address.toLowerCase() : ""
          }
        },
        {
          field: "address_district",
          title: "Р-н",
          sortable: true,
          width: 100,
          autoHide: true,

          template (row) {
            return row.address_district ? row.address_district.toLowerCase() : ""
          }
        },
        {
          field: "address_microdistrict",
          title: "Мкр-н",
          sortable: true,
          width: 100,
          autoHide: true,

          template (row) {
            return row.address_microdistrict ? row.address_microdistrict.toLowerCase() : ""
          }
        },
        {
          field: "rooms",
          title: "Комнат",
          sortable: true,
          width: 100,
          autoHide: false
        },
        {
          field: "floor",
          title: "Этаж",
          sortable: true,
          width: 100,
          autoHide: true
        },
        {
          field: "floors",
          title: "Этажность",
          sortable: true,
          width: 100,
          autoHide: true
        },
        {
          field: "year_built",
          title: "Год.п.",
          sortable: true,
          width: 100,
          autoHide: false
        },
        {
          field: "size_total",
          title: "Пл.общ.",
          sortable: true,
          width: 100,
          autoHide: false
        },
        {
          field: "size_living",
          title: "Пл.жил",
          sortable: true,
          width: 100,
          autoHide: true
        },
        {
          field: "size_kitchen",
          title: "Пл.кухни",
          sortable: true,
          width: 100,
          autoHide: true
        },
        {
          field: "price_amount",
          title: "Цена",
          sortable: true,
          width: 100,
          autoHide: false
        },
        {
          field: "price_sq_m_amount",
          title: "Цена/кв.м",
          sortable: true,
          width: 100,
          autoHide: true
        },
        {
          field: "actions",
          title: "Действия",
          sortable: false,
          width: 100,
          overflow: "visible",
          autoHide: false,

          template (row) {
            let template = `\
              <a href="` + row.url + `" class="btn btn-sm btn-clean btn-icon mr-2" target="_blank" title="Открыть источник">\
                <span class="svg-icon svg-icon-md">\
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                      <rect x="0" y="0" width="24" height="24"/>\
                      <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>\
                      <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>\
                    </g>\
                  </svg>\
                </span>\
              </a>`

            if (row.address_coordinates_lat && row.address_coordinates_long) {
              template += `\
                <a href="" class="btn btn-sm btn-clean btn-icon mr-2" role="button" data-toggle="modal" data-target="#mapModal" data-lat="` + row.address_coordinates_lat + `" data-long="` + row.address_coordinates_long + `" data-address="` + row.full_address + `" title="Посмотреть на карте">\
                  <span class="svg-icon svg-icon-md">\
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">\
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">\
                        <rect x="0" y="0" width="24" height="24"/>\
                        <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/>\
                      </g>\
                    </svg>\
                  </span>\
                </a>`
            }

            return template
          }
        }
      ]
    })
  },

  methods: {
    /**
     * Searches ads.
     */
    applySearch () {
      this.datatable.setDataSourceParam("query", {
        search: this.search
      })

      this.datatable.load()
    },

    /**
     * Filters ads.
     */
    applyFilters () {
      this.datatable.setDataSourceParam("params", this.datatableParams)
      this.datatable.load()
    },

    /**
     * Resets filters to the initial state.
     */
    resetFilters () {
      window.$("#source").val("default").selectpicker("refresh")
      window.$("#rooms").val("default").selectpicker("refresh")
      this.$store.commit("ads/resetFilters")
      this.datatable.setDataSourceParam("params", {})
      this.datatable.load()
    }
  }
}
</script>
