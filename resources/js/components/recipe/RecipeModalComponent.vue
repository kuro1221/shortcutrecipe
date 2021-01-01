<template>
  <v-row justify="center">
    <v-dialog
      v-model="modalFlg"
      min-width="350"
      height="250"
    >
      <v-card class="pa-2">
        <div v-if="showURL">
          <v-card-text>これより外部のサイトにアクセスします。よろしければ下記リンク先のURLをクリックして下さい。<br>ショートカットをダウンロードする前に安全性を確認してください。
          </v-card-text>
          <v-card-text class="pt-0"><a :href="recipe.iCloud_link">{{recipe.iCloud_link}}</a></v-card-text>
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
            <v-avatar size="50px">
              <v-img
                v-bind:src="'../storage/' + recipe.img"
                aspect-ratio="1.7"
                contain
              />
            </v-avatar>
            <v-card-text class="ml-2 font-weight-bold text-truncate">{{ recipe.name }}</v-card-text>
            <v-spacer></v-spacer>
            <v-btn class="button_small" color="#FFD500" rounded small @click="showURL = true">GET</v-btn>
            <v-icon class="ml-1" @click="modalFlg = false">mdi-close</v-icon>
          </v-card-actions>
        </div>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
export default {
  props: ["recipe"],
  data: function() {
    return {
      modalFlg:false,
      showURL: false
    }
  },
  watch: {
    recipe: function(recipe){
      if(recipe) {
        this.modalFlg = true;
      } else {
        this.modFlg = false;
        this.showURL = false;
      }
    },
    modalFlg: function(modalFlg){
      if (this.recipe && this.modalFlg == false) this.$emit('reset');
    }
  }
}
</script>
