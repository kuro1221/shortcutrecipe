<template>
  <v-app>
    <v-content class="fill-height" fluid>
      <v-row justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-card class="elevation-12">
            <v-toolbar color="primary" dark flat>
              <v-toolbar-title>レシピ登録</v-toolbar-title>
              <v-spacer />
            </v-toolbar>
            <v-card-text>
              <v-form ref="form">
                <v-text-field
                  v-model="recipe.recipe_name"
                  label="レシピ名"
                  name="recipe_name"
                  prepend-icon="fas fa-utensils"
                  type="text"
                  :rules="[rule.required, rule.limit_max_name]"
                  :error-messages="errors.recipe_name"
                />
                <v-text-field
                  v-model="recipe.iCloud_link"
                  label="iCloudリンク"
                  name="iCloud_link"
                  prepend-icon="fas fa-utensils"
                  type="text"
                  :rules="[rule.required, rule.limit_max_link]"
                  :error-messages="errors.iCloud_link"
                />
                <v-select
                  v-model="recipe.select_product"
                  :items="product_list"
                  item-text="product_name"
                  item-value="id"
                  multiple
                  label="使用する製品(複数選択可能)"
                  chips
                  prepend-icon="fas fa-utensils"
                ></v-select>
                <v-select
                  v-model="recipe.select_application"
                  :items="application_list"
                  item-text="application_name"
                  item-value="id"
                  multiple
                  label="対象アプリ(複数選択可能)"
                  chips
                  prepend-icon="fas fa-utensils"
                ></v-select>
                <v-select
                  v-model="recipe.select_situation"
                  :items="situation_list"
                  item-text="situation_name"
                  item-value="id"
                  multiple
                  label="使用状況(複数選択可能)"
                  chips
                  prepend-icon="fas fa-utensils"
                ></v-select>
                <v-textarea
                  v-model="recipe.comment"
                  label="コメント"
                  autocomplete="comment"
                  prepend-icon="far fa-comment"
                  :rules="[rule.limit_max_comment]"
                  counter="200"
                ></v-textarea>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer />
              <v-btn color="primary" @click="editRecipe">編集</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-content>
  </v-app>
</template>
<script>
import validation_rule from '../../validation'
export default {
  props: ['props_recipe','props_select_application','props_select_product','props_select_situation','application_list', 'product_list', 'situation_list'],
  data: function() {
    return {
      rule: validation_rule,
      recipe: '',
      errors: {
      }
    }
  },
  created: function() {
      this.recipe = this.props_recipe
      this.recipe.select_application = [];
      this.recipe.select_product = [];
      this.recipe.select_situation = [];
      for(let i =0; i<this.props_select_product.length;i++) {
        this.recipe.select_product.push(this.props_select_product[i].product_id);
      }
      for(let i =0; i<this.props_select_application.length;i++) {
        this.recipe.select_application.push(this.props_select_application[i].application_id);
      }
      for(let i =0; i<this.props_select_situation.length;i++) {
        this.recipe.select_situation.push(this.props_select_situation[i].situation_id);
      }
      this.recipe.comment = "書き換え"
  },
  methods: {
    editRecipe: function(e) {
      if(this.$refs.form.validate()){
        let self = this;
        self.errors = {
          recipe_name: '',
          iCloud_link: '',
          comment: '',
        }
        axios.post('/editRecipe/'+this.recipe.id,this.recipe
        ).then(function(){
          self.errors = [];
          location.href = '/home'
        }).catch(function(error){
          for(let key in error.response.data.errors) {
            self.errors[key] = error.response.data.errors[key][0];
          }
        });
      }
    },
  },
}
</script>
