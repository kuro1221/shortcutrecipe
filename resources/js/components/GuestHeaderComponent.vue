<template>
  <div>
    <!-- スマホ・タブレット表示 -->
    <div class="hidden-md-and-up">
      <v-navigation-drawer
        v-model="drawer"
        app
        right
      >
        <v-row justify="center">
          <v-list class="mt-8 font-weight-bold">
            <v-list-item link href="/recipeList">
              <v-list-item-content>
                <v-list-item-title>レシピ一覧</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-list-item link href="/login">
              <v-list-item-content>
                <v-list-item-title>ログイン</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
            <v-list-item link href="/register">
              <v-list-item-content>
                <v-list-item-title>新規登録</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-row justify="center">
      </v-navigation-drawer>
      <v-app-bar app :color="defaultCSS.backgroundColor">
        <v-toolbar-title><a href="/" class="link">Shortcut Recipe</a></v-toolbar-title>
        <v-spacer></v-spacer>
        <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      </v-app-bar>
    </div>
    <!-- PC表示 -->
    <div class="hidden-sm-and-down">
      <v-app-bar app :color="defaultCSS.backgroundColor">
        <v-toolbar-title><a href="/" class="link">Shortcut Recipe</a></v-toolbar-title>
        <v-spacer></v-spacer>
        <v-list class="mt-8 font-weight-bold d-flex">
          <v-list-item link href="/recipeList">
            <v-list-item-content>
              <v-list-item-title>レシピ一覧</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item link href="/login">
            <v-list-item-content>
              <v-list-item-title>ログイン</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item link href="/register">
            <v-list-item-content>
              <v-list-item-title>新規登録</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-app-bar>
    </div>
  </div>
</template>
<script>
import defaultCSS from '../default.js'
export default {
  components: {
  },
  data: function() {
    return {
      defaultCSS: defaultCSS,
      drawer: null,
    }
  },
  methods: {
    logout: function() {
      axios.post('logout',
      ).then(function(){
        location.href = '/login'
      })
    }
  }
}
</script>
