<template>
  <v-app>
    <v-content class="fill-height" fluid>
      <v-flex xs12 md4 v-for="(recipe, i) in sliceRecipes" :key="i" class="no-border">
        <v-card-title>{{recipe.id}}</v-card-title>
      </v-flex>
    </v-content>
    <paginate
      :page-count="getPageCount"
      :page-range="3"
      :margin-pages="2"
      :click-handler="clickCallback"
      :prev-text="'<'"
      :prev-link-class="'p-page__prev'"
      :next-text="'>'"
      :next-link-class="'p-page__next'"
      :container-class="'p-pagination'"
      :page-class="'p-page__item'"
      :page-link-class="'p-page__item-link'"
      :hide-prev-next="true"
    ></paginate>
  </v-app>
</template>
<script>
import Paginate from "vuejs-paginate";
Vue.component("paginate", Paginate);
export default {
  props: ["recipe_list"],
  data: function() {
    return {
      perPage: 9, //1ページあたりの表示商品数
      currentPage: 1,
    }
  },
  methods: {
    //現在のページ数を取得（ページネーション用)
    clickCallback: function(pageNum) {
      this.currentPage = Number(pageNum);
    }
  },
  computed: {
    //現在のページに表示する商品を取得
    sliceRecipes: function() {
      var current = this.currentPage * this.perPage;
      var start = current - this.perPage;
      //絞り込んだ商品を数ページに分ける
      return this.recipe_list.slice(start, current);
    },
    //トータルページ数を取得
    getPageCount: function() {
      return Math.ceil(this.recipe_list.length / this.perPage);
    }
  }
}
</script>
