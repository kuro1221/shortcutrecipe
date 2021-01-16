<template>
  <div>
    <v-content class="fill-height pt-0" red >
      <v-row justify="center" red class="pt-0">
        <v-col cols="12" sm="8" md="9">
      <recipe-filter :filter_data.sync="filter_data" :search.sync="search" :sort_order.sync="sort_order" :application_list="application_list" :product_list="product_list" :situation_list="situation_list"></recipe-filter>
      <recipe :auth_user="auth_user" :recipe_list="filterdList"></recipe>
      </v-col>
      </v-row>
    </v-content>
  </div>
</template>
<script>
import defaultCSS from '../../default.js'
import recipeFilter from '../recipe/RecipeFilterComponent.vue';
import recipe from '../recipe/RecipeComponent.vue';
export default {
  props: ["auth_user","recipes","application_list","product_list","situation_list"],
  components: {
    'recipe-filter': recipeFilter,
    'recipe': recipe
  },
  data: function() {
    return {
      defaultCSS: defaultCSS,
      filter_data:{
        filter_application: [],
        filter_product: [],
        filter_situation: [],
      },
      search: '',
      sort_order: 1,
      errors: {
      }
    }
  },
  computed: {
    filterdList: function () {
      let newList = [];
      this.recipes.forEach(recipe => {
        let isShow = true;

        //選択結果からフィルタリング
        if(this.filter_data.filter_product.length > 0) {
          if(!this.filterSelection(this.filter_data.filter_product,recipe.select_products,"product_id")){
            isShow = false;
          }
        }

        if(this.filter_data.filter_situation.length > 0) {
          if(!this.filterSelection(this.filter_data.filter_situation,recipe.select_situations,"situation_id")){
            isShow = false;
          }
        }

        if(this.filter_data.filter_application.length > 0) {
          if(!this.filterSelection(this.filter_data.filter_application,recipe.select_applications,"application_id")){
            isShow = false;
          }
        }
        //検索値からフィルタリング
        if (this.search.length > 0) {
          if(!(recipe.recipe_name.match(this.search) ||
          (recipe.comment && recipe.comment.match(this.search)) ||
            this.filterSelection(this.search,recipe.select_products,"product_name") ||
            this.filterSelection(this.search,recipe.select_applications,"application_name")
            // this.filterSelection(this.search,recipe.select_situations,"situation_name")
            // this.includeSearch(recipe.select_products,"product_name",this.search) ||
            // this.includeSearch(recipe.select_applications,"application_name",this.search) ||
          )){
            isShow = false;
          }
        }
        if (isShow) newList.push(recipe)
      })
      switch (this.sort_order){
        case 1: //新しい順
          newList.sort(function(a,b){
            return (a.updated_at < b.updated_at)? 1: -1;
          })
          break;
        case 2:
          newList.sort(function(a,b){
            return (a.updated_at < b.updated_at)? -1: 1;
          })
          break;
      }
      return newList;
    }
  },
  methods: {
    filterSelection: function(filters,selections,type){
      console.log("filterしたやつ:"+filters); //[0,1,2]みたいな形で選択した製品IDが送られる
      console.log(selections); //レシピの選択した製品ID [product_id:1,product_id:2]みたいな感じ？
      let result = selections.find(function(selection){
        console.log("index結果"+filters.indexOf(selection[type]))
        return filters.includes(selection[type]);
      })
      console.log(result);
      if(result && result.id) return result;
    }
  }
}
</script>
