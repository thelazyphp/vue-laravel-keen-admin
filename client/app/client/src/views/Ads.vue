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
          <div class="modal-header">
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
            <div class="form-group">
              <label for="rooms">Комнат</label>
              <select
                id="rooms"
                v-model.number="filters.rooms"
                class="form-control selectpicker"
                title="Любое количество"
                data-actions-box="true"
                multiple
              >
                <option :value="1">1</option>
                <option :value="2">2</option>
                <option :value="3">3</option>
                <option :value="4">4 и более</option>
              </select>
            </div>
            <div class="form-group">
              <label for="floor">Этаж</label>
              <div class="input-group">
                <select
                  id="floor"
                  v-model.number="filters.floor.min"
                  class="form-control"
                >
                  <option :value="null">C</option>
                  <option
                    v-for="n in 19"
                    :key="n"
                    :value="n"
                  >
                    {{ n }}
                  </option>
                  <option :value="20">20 и более</option>
                </select>
                <select
                  v-model.number="filters.floor.max"
                  class="form-control"
                >
                  <option :value="null">По</option>
                  <option
                    v-for="n in 19"
                    :key="n"
                    :value="n"
                  >
                    {{ n }}
                  </option>
                  <option :value="20">20 и более</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="floors">Этажность</label>
              <div class="input-group">
                <select
                  id="floors"
                  v-model.number="filters.floors.min"
                  class="form-control"
                >
                  <option :value="null">С</option>
                  <option
                    v-for="n in 19"
                    :key="n"
                    :value="n"
                  >
                    {{ n }}
                  </option>
                  <option :value="20">20 и более</option>
                </select>
                <select
                  v-model.number="filters.floors.max"
                  class="form-control"
                >
                  <option :value="null">По</option>
                  <option
                    v-for="n in 19"
                    :key="n"
                    :value="n"
                  >
                    {{ n }}
                  </option>
                  <option :value="20">20 и более</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="yearBuilt">Год постройки</label>
              <div class="input-group">
                <select
                  id="yearBuilt"
                  v-model.number="filters.yearBuilt.min"
                  class="form-control"
                >
                  <option :value="null">С</option>
                  <option
                    v-for="n in yearsBuilt"
                    :key="n"
                    :value="n"
                  >
                    {{ n }}
                  </option>
                  <option :value="yearsBuilt[yearsBuilt.length - 1] - 1">{{ yearsBuilt[yearsBuilt.length - 1] - 1 }} и ранее</option>
                </select>
                <select
                  v-model.number="filters.yearBuilt.max"
                  class="form-control"
                >
                  <option :value="null">По</option>
                  <option
                    v-for="n in yearsBuilt"
                    :key="n"
                    :value="n"
                  >
                    {{ n }}
                  </option>
                  <option :value="yearsBuilt[yearsBuilt.length - 1] - 1">{{ yearsBuilt[yearsBuilt.length - 1] - 1 }} и ранее</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-light-primary font-weight-bold"
              data-dismiss="modal"
            >
              Закрыть
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
        <div
          id="kt_datatable_apartments"
          class="datatable datatable-bordered datatable-head-custom"
        >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex"
import {
  SET_PAGE_TITLE
} from "../store"

export default {
  data () {
    return {
      datatable: null,
      filters: {
        rooms: [],
        floor: {
          min: null,
          max: null
        },
        floors: {
          min: null,
          max: null
        },
        yearBuilt: {
          min: null,
          max: null
        }
      }
    }
  },
  computed: {
    ...mapGetters([
      "auth/token"
    ]),
    yearsBuilt () {
      const cur = new Date().getFullYear()
      const min = cur - 49
      const max = cur + 10
      let years = []

      for (let year = max; year >= min; year--) {
        years.push(year)
      }

      return years
    }
  },
  beforeMount () {
    this[SET_PAGE_TITLE]("Объявления")
  },
  mounted () {
    this.datatable = window.$("#kt_datatable_apartments").KTDatatable({
      data: {
        type: "remote",
        source: {
          read: {
            url: process.env.BASE_URL + "api/ads",
            method: "GET",
            headers: {
              "authorization": "Bearer " + this["auth/token"]
            }
          }
        },
        serverPaging: true,
        serverSorting: true
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
        input: window.$("#kt_datatable_apartments_search_query")
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
          width: 100,
          autoHide: true
        },
        {
          field: "image",
          title: "Фото",
          sortable: false,
          width: 64,
          autoHide: true,
          template: (row) => {
            let image = ""

            if (row.images.length) {
              image = "<div style='display: inline-block; width: 64px; height: 64px; background-image: url(" + (row.images[0].thumb || row.images[0].src) + "); background-size: cover; background-repeat: no-repeat; background-position: center center'></div>"
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
          template: (row) => {
            return new Date(row.published_at).toLocaleDateString()
          }
        },
        {
          field: "full_address",
          title: "Адрес",
          sortable: true,
          width: 100,
          autoHide: true
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
        }
      ]
    })
  },
  methods: {
    ...mapMutations([
      SET_PAGE_TITLE
    ]),
    applyFilters () {
      let params = {}

      if (this.filters.rooms.length) {
        params["r"] = "in:" + this.filters.rooms.join(",")
      }

      if (this.filters.floor.min) {
        params["f"] = "ge:" + this.filters.floor.min
      }

      if (this.filters.floor.max) {
        params["f"] = "le:" + this.filters.floor.max
      }

      if (this.filters.floors.min) {
        params["fs"] = "ge:" + this.filters.floors.min
      }

      if (this.filters.floors.max) {
        params["fs"] = "le:" + this.filters.floors.max
      }

      if (this.filters.yearBuilt.min) {
        params["yb"] = "ge:" + this.filters.yearBuilt.min
      }

      if (this.filters.yearBuilt.max) {
        params["yb"] = "le:" + this.filters.yearBuilt.max
      }

      this.datatable.setDataSourceParam("params", params)
      this.datatable.load()
    }
  }
}
</script>
