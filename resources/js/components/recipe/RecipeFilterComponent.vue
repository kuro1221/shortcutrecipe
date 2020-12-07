<template>
  <v-app>
    <v-content class="fill-height" fluid>
      <v-select
        v-model="child_sort_order"
        :items="sort_orders"
        item-text="label"
        item-value="value"
        label="並べ替え"
        dense
      ></v-select>
      <v-text-field
        v-model="child_search"
        label="検索"
        name="search"
        prepend-icon="search"
        type="text"
        :rules=[rule.limit_max_length]
      />
      <v-select
        v-model="filter_data.filter_product"
        :items="product_list"
        item-text="product_name"
        item-value="id"
        multiple
        label="製品(複数選択可能)"
        chips
        prepend-icon="fas fa-utensils">
      </v-select>
    </v-content>
    <v-content class="fill-height" fluid>
      <v-select
        v-model="filter_data.filter_application"
        :items="application_list"
        item-text="application_name"
        item-value="id"
        multiple
        label="アプリ(複数選択可能)"
        chips
        prepend-icon="fas fa-utensils">
      </v-select>
    </v-content>
    <v-content class="fill-height" fluid>
      <v-select
        v-model="filter_data.filter_situation"
        :items="situation_list"
        item-text="situation_name"
        item-value="id"
        multiple
        label="状況(複数選択可能)"
        chips
        prepend-icon="fas fa-utensils">
      </v-select>
    </v-content>
  </v-app>
</template>
<script>
import validation_rule from '../../validation.js'
export default {
  props: ["filter_data","search","sort_order","application_list","product_list","situation_list"],
  data: function() {
    return {
      rule: validation_rule,
      sort_orders: [
        {label: "新しい順" , value: 1 },
        {label: "古い順", value:2 },
      ]
    }
  },
  computed: {
    child_search: {
      get: function () {
        return this.search
      },
      set: function (val) {
        this.$emit('update:search', val)
      }
    },
    child_sort_order: {
      get: function() {
        return this.sort_order
      },
      set: function(val) {
        this.$emit('update:sort_order',val)
      }
    }
  }
 }
</script>
