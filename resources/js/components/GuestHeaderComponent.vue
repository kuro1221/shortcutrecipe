<template>
    <div>
        <v-navigation-drawer v-model="drawer" app right>
            <v-row justify="center">
                <v-list class="mt-8 font-weight-bold">
                    <v-list-item link href="/recipeList">
                        <v-list-item-content>
                            <v-list-item-title
                                ><span class="icon_area"
                                    ><v-icon class="mr-3"
                                        >fas fa-list</v-icon
                                    ></span
                                >レシピ一覧</v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link href="/login">
                        <v-list-item-content>
                            <v-list-item-title
                                ><span class="icon_area"
                                    ><v-icon class="mr-3" font-size="40"
                                        >fas fa-sign-in-alt</v-icon
                                    ></span
                                >ログイン</v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link href="/register">
                        <v-list-item-content>
                            <v-list-item-title
                                ><span class="icon_area"
                                    ><v-icon class="mr-3" width="30"
                                        >fas fa-user-plus</v-icon
                                    ></span
                                >新規登録</v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-row>
        </v-navigation-drawer>
        <v-app-bar app :color="defaultCSS.backgroundColor">
            <v-toolbar-title
                ><a href="/" class="link">Shortcut Recipe</a></v-toolbar-title
            >
            <a class="headerItem" href="/introducePage">使い方</a>
            <v-spacer></v-spacer>
            <div class="hidden-md-and-down">
                <v-list
                    class="pc-header-list d-flex"
                    :color="defaultCSS.backgroundColor"
                >
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
                        <v-list-item-title>新規登録</v-list-item-title>
                    </v-list-item>
                </v-list>
            </div>
            <div class="hidden-lg-and-up">
                <v-app-bar-nav-icon
                    @click="drawer = !drawer"
                ></v-app-bar-nav-icon>
            </div>
        </v-app-bar>
    </div>
</template>
<script>
import defaultCSS from "../default.js";
export default {
    components: {},
    data: function() {
        return {
            defaultCSS: defaultCSS,
            drawer: false
        };
    },
    methods: {
        logout: function() {
            axios.post("logout").then(function() {
                location.href = "/login";
            });
        }
    }
};
</script>
