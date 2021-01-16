<template>
  <div>
    <v-navigation-drawer
      v-model="drawer"
      app
      right
    >
      <v-row justify="center">
        <v-list class="mt-8 font-weight-bold">
         <v-list-item link :href="'/userDetail/' + auth_user.id">
            <v-list-item-content>
              <v-list-item-title>マイページ</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item link href="/recipeList">
            <v-list-item-content>
              <v-list-item-title>レシピ一覧</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item link href="/addRecipe">
            <v-list-item-content>
              <v-list-item-title>レシピ追加</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item link href="/profileEdit">
            <v-list-item-content>
              <v-list-item-title>プロフィール編集</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item link href="/passwordEdit">
            <v-list-item-content>
              <v-list-item-title>パスワード変更</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item link href="/withdrawalShow">
            <v-list-item-content>
              <v-list-item-title>退会</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title><button @click="logout">ログアウト</button></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-row>
    </v-navigation-drawer>
    <v-app-bar app :color="defaultCSS.backgroundColor">
      <v-toolbar-title><a href="/" class="link">Shortcut Recipe</a></v-toolbar-title>
      <v-spacer></v-spacer>
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
    </v-app-bar>
  </div>
</template>
<script>
import defaultCSS from '../default.js'
export default {
  props:["auth_user"],
  data: function() {
    return {
      defaultCSS: defaultCSS,
      drawer: null,
    }
  },
  methods: {
    logout: function() {
      axios.post('/logout',
      ).then(function(){
        location.href = '/login'
      })
    }
  }
}
</script>
