<template>
  <form @submit.prevent>
    <div class="form-group">
      <label for="transaction">Тип сделки</label>
      <select
        id="transaction"
        v-model="filters.transaction"
        class="form-control"
      >
        <option :value="null">Любой</option>
        <option
          v-for="(value, key) in options.transaction"
          :key="key"
          :value="key"
        >
          {{ value }}
        </option>
      </select>
    </div>
    <div class="form-group">
      <label for="sellerType">Продавец</label>
      <select
        id="sellerType"
        v-model="filters.sellerType"
        class="form-control"
      >
        <option :value="null">Любой</option>
        <option
          v-for="(value, key) in options.sellerType"
          :key="key"
          :value="key"
        >
          {{ value }}
        </option>
      </select>
    </div>
    <div class="form-group">
      <label for="source">Источник</label>
      <select
        id="source"
        v-model="filters.source"
        class="form-control selectpicker"
        multiple
        data-none-selected-text="Все источники"
        data-live-search="true"
        data-actions-box="true"
        data-select-all-text="Выбрать все"
        data-deselect-all-text="Убрать все"
        data-none-results-text="Нет совпадений с {0}"
      >
        <option
          v-for="(value, key) in options.source"
          :key="key"
          :value="key"
        >
          {{ value }}
        </option>
      </select>
    </div>
    <div class="form-group">
      <label for="rooms">Комнат</label>
      <select
        id="rooms"
        v-model="filters.rooms"
        class="form-control selectpicker"
        multiple
        data-none-selected-text="Любое количество"
        data-actions-box="true"
        data-select-all-text="Выбрать все"
        data-deselect-all-text="Убрать все"
      >
        <option
          v-for="(value, key) in options.rooms"
          :key="key"
          :value="key"
        >
          {{ value }}
        </option>
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
            v-for="(value, key) in options.floor"
            :key="key"
            :value="key"
          >
            {{ value }}
          </option>
        </select>
        <select
          v-model.number="filters.floor.max"
          class="form-control"
        >
          <option :value="null">По</option>
          <option
            v-for="(value, key) in options.floor"
            :key="key"
            :value="key"
          >
            {{ value }}
          </option>
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
            v-for="(value, key) in options.floors"
            :key="key"
            :value="key"
          >
            {{ value }}
          </option>
        </select>
        <select
          v-model.number="filters.floors.max"
          class="form-control"
        >
          <option :value="null">По</option>
          <option
            v-for="(value, key) in options.floors"
            :key="key"
            :value="key"
          >
            {{ value }}
          </option>
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
            v-for="(value, key) in options.yearBuilt"
            :key="key"
            :value="key"
          >
            {{ value }}
          </option>
        </select>
        <select
          v-model.number="filters.yearBuilt.max"
          class="form-control"
        >
          <option :value="null">По</option>
          <option
            v-for="(value, key) in options.yearBuilt"
            :key="key"
            :value="key"
          >
            {{ value }}
          </option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="sizeTotal">Общая площадь</label>
      <div class="input-group">
        <input
          id="sizeTotal"
          v-model.number="filters.sizeTotal.min"
          type="number"
          class="form-control"
          min="0.1"
          step="0.1"
          placeholder="От"
        >
        <input
          v-model.number="filters.sizeTotal.max"
          type="number"
          class="form-control"
          min="0.1"
          step="0.1"
          placeholder="До"
        >
      </div>
    </div>
    <div class="form-group">
      <label for="sizeLiving">Жилая площадь</label>
      <div class="input-group">
        <input
          id="sizeLiving"
          v-model.number="filters.sizeLiving.min"
          type="number"
          class="form-control"
          min="0.1"
          step="0.1"
          placeholder="От"
        >
        <input
          v-model.number="filters.sizeLiving.max"
          type="number"
          class="form-control"
          min="0.1"
          step="0.1"
          placeholder="До"
        >
      </div>
    </div>
    <div class="form-group">
      <label for="sizeKitchen">Площадь кухни</label>
      <div class="input-group">
        <input
          id="sizeKitchen"
          v-model.number="filters.sizeKitchen.min"
          type="number"
          class="form-control"
          min="0.1"
          step="0.1"
          placeholder="От"
        >
        <input
          v-model.number="filters.sizeKitchen.max"
          type="number"
          class="form-control"
          min="0.1"
          step="0.1"
          placeholder="До"
        >
      </div>
    </div>
    <div class="form-group">
      <label for="priceAmount">Цена</label>
      <div class="input-group">
        <input
          id="priceAmount"
          v-model.number="filters.priceAmount.min"
          type="number"
          class="form-control"
          min="1"
          step="1"
          placeholder="От"
        >
        <input
          v-model.number="filters.priceAmount.max"
          type="number"
          class="form-control"
          min="1"
          step="1"
          placeholder="До"
        >
      </div>
    </div>
    <div class="form-group">
      <label for="priceSqMAmount">Цена за квадратный метр</label>
      <div class="input-group">
        <input
          id="priceSqMAmount"
          v-model.number="filters.priceSqMAmount.min"
          type="number"
          class="form-control"
          min="1"
          step="1"
          placeholder="От"
        >
        <input
          v-model.number="filters.priceSqMAmount.max"
          type="number"
          class="form-control"
          min="1"
          step="1"
          placeholder="До"
        >
      </div>
    </div>
  </form>
</template>

<script>
export default {
  name: "FiltersForm",

  props: {
    value: {
      type: Object,
      required: true
    },
    options: {
      type: Object,
      required: true
    }
  },

  data () {
    return {
      filters: this.value
    }
  },

  watch: {
    filters: {
      deep: true,

      handler (value) {
        this.$emit("input", value)
      }
    }
  }
}
</script>
