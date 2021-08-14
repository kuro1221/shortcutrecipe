<template>
  <v-row justify="center">
    <v-dialog
      v-model="modalFlg"
      min-width="350"
      max-width="600"
      height="250"
    >
      <v-card class="pa-2">
        <div v-if="showURL">
          <v-card-text>これより外部のサイトにアクセスします。よろしければ下記リンク先のURLをクリックして下さい。<br>ショートカットをダウンロードする前に安全性を確認してください。
          </v-card-text>
          <v-card-text class="pt-0"><a :href="recipe.iCloud_link">{{recipe.iCloud_link}}</a></v-card-text>
        </div>
        <div v-else-if="deleteRecipeId">
          <v-card-text class="font-weight-bold">
            本当に削除してもよろしいですか？
          </v-card-text>
          <v-card-actions class="mb-2">
            <v-spacer></v-spacer>
            <v-btn class="button_small font-weight-bold" color="#FFD500" rounded small @click="deleteRecipe">はい</v-btn>
            <v-spacer></v-spacer>
            <v-btn class="button_small font-weight-bold" color="#FFD500" rounded small @click="modalFlg = false">いいえ</v-btn>
            <v-spacer></v-spacer>
          </v-card-actions>
        </div>
        <div v-else>
          <v-card-title class="pa-0 ma-2 subtitle-1 font-weight-bold">
            {{recipe.recipe_name}}
          </v-card-title>
          <v-card-text class="pa-0 ma-2 button text--secondary font-weight-bold">{{recipe.comment}}</v-card-text>
          <v-chip
            class="ma-1 mb-2"
            color="primary"
            outlined
            pill
            v-for="(select_product,key,index) in recipe.select_products"
            :key="index"
          >{{ select_product.product_name }}
          </v-chip>
          <v-chip
            class="ma-1"
            color="primary"
            outlined
            pill
            v-for="(select_applications,key,index) in recipe.select_applications"
            :key="index"
          >{{ select_applications.application_name }}
          </v-chip>
          <v-card-actions>
            <v-avatar size="60px">
              <v-img
                v-if="recipe.img"
                v-bind:src="'../storage/' + recipe.img"
                aspect-ratio="1.7"
              />
              <v-img
                v-else
                :src="'/../storage/no-image.png'"
                aspect-ratio="1.7"
              />
            </v-avatar>
            <v-card-text class="ml-1 font-weight-bold text-truncate"><a class="link" :href="'/userDetail/' + recipe.user_id">{{ recipe.name }}</a></v-card-text>
          </v-card-actions>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn class="button_small ml-3" color="#FFD500" rounded small v-if="recipe.user_id === auth_user.id" :href="'/editRecipe/' + recipe.id">編集</v-btn>
            <v-btn class="button_small ml-3" color="#FFD500" rounded small v-if="recipe.user_id === auth_user.id" @click="deleteRecipeId = recipe.id">削除</v-btn>
            <v-btn class="button_small ml-3" color="#FFD500" rounded small @click="showURL = true">GET</v-btn>
            <v-icon class="ml-2" @click="modalFlg = false">mdi-close</v-icon>
          </v-card-actions>
        </div>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
export default {
  props: ["auth_user","recipe"],
  data: function() {
    return {
      modalFlg:false,
      showURL: false,
      deleteRecipeId: '',
    }
  },
  watch: {
    recipe: function(recipe){
      if(recipe) {
        this.modalFlg = true;
      } else {
        this.modFlg = false;
        this.showURL = false;
        this.deleteRecipeId = '';
      }
    },
    modalFlg: function(modalFlg){
      if (this.recipe && this.modalFlg == false) this.$emit('reset');
    }
  },
  methods: {
    deleteRecipe: function(){
      axios.post('/deleteRecipe/' + this.deleteRecipeId,
      ).then(function(){
        self.errors = [];
        location.href = '/'
      })
    }
  }
}
</script>
