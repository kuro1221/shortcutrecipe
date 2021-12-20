<template>
    <div>
        <v-navigation-drawer v-model="drawer" app right disable-resize-watcher>
            <v-row justify="end">
                <v-icon class="mt-4 mr-10" @click="drawer = !drawer">
                    fas fa-times
                </v-icon>
            </v-row>
            <v-row justify="center">
                <v-list class="mt-8 font-weight-bold">
                    <v-list-item link :href="'/userDetail/' + auth_user.id">
                        <v-list-item-content>
                            <v-list-item-title
                                ><span class="icon_area"
                                    ><v-icon class="mr-2"
                                        >fas fa-user-alt</v-icon
                                    ></span
                                >マイページ</v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link href="/recipeList">
                        <v-list-item-content>
                            <v-list-item-title
                                ><span class="icon_area"
                                    ><v-icon class="mr-2"
                                        >fas fa-list</v-icon
                                    ></span
                                >レシピ一覧</v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link href="/addRecipe">
                        <v-list-item-content>
                            <v-list-item-title
                                ><span class="icon_area"
                                    ><v-icon class="mr-2"
                                        >fas fa-plus</v-icon
                                    ></span
                                >レシピ追加</v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link href="/profileEdit">
                        <v-list-item-content>
                            <v-list-item-title
                                ><span class="icon_area"
                                    ><v-icon class="mr-2"
                                        >fas fa-user-cog</v-icon
                                    ></span
                                >プロフィール編集</v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link href="/passwordEdit">
                        <v-list-item-content>
                            <v-list-item-title
                                ><span class="icon_area"
                                    ><v-icon class="mr-2"
                                        >fas fa-key</v-icon
                                    ></span
                                >パスワード変更</v-list-item-title
                            >
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link href="/withdrawalShow">
                        <v-list-item-content>
                            <v-list-item-title>
                                <span class="icon_area">
                                    <v-icon class="mr-2">
                                        fas fa-sign-out-alt
                                    </v-icon>
                                </span>
                                退会
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title>
                                <span class="icon_area">
                                    <v-icon class="mr-2">
                                        fas fa-sign-out-alt
                                    </v-icon>
                                </span>
                                <button @click="logout">ログアウト</button>
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                    <v-list-item link href="/introducePage">
                        <v-list-item-content>
                            <v-list-item-title
                                ><span class="icon_area"
                                    ><v-icon class="mr-3" width="30"
                                        >fas fa-question-circle</v-icon
                                    ></span
                                >使い方</v-list-item-title
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
            <v-spacer></v-spacer>
            <v-app-bar app :color="defaultCSS.backgroundColor">
                <v-toolbar-title
                    ><a href="/" class="link"
                        >Shortcut Recipe</a
                    ></v-toolbar-title
                >
                <v-spacer></v-spacer>
                <div class="hidden-md-and-down">
                    <v-list
                        class="pc-header-list d-flex"
                        :color="defaultCSS.backgroundColor"
                    >
                        <v-list-item link :href="'/userDetail/' + auth_user.id">
                            <v-list-item-content>
                                <v-list-item-title
                                    >マイページ</v-list-item-title
                                >
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item link href="/recipeList">
                            <v-list-item-content>
                                <v-list-item-title
                                    >レシピ一覧</v-list-item-title
                                >
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item link href="/addRecipe">
                            <v-list-item-content>
                                <v-list-item-title
                                    >レシピ追加</v-list-item-title
                                >
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item link href="/profileEdit">
                            <v-list-item-content>
                                <v-list-item-title
                                    >プロフィール編集</v-list-item-title
                                >
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item link href="/passwordEdit">
                            <v-list-item-content>
                                <v-list-item-title
                                    >パスワード変更</v-list-item-title
                                >
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item link href="/withdrawalShow">
                            <v-list-item-content>
                                <v-list-item-title>退会</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item>
                            <v-list-item-content>
                                <v-list-item-title
                                    ><button @click="logout">
                                        ログアウト
                                    </button></v-list-item-title
                                >
                            </v-list-item-content>
                        </v-list-item>
                        <v-list-item link href="/introducePage">
                            <v-list-item-content>
                                <v-list-item-title>使い方</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                </div>
                <div class="hidden-lg-and-up">
                    <v-app-bar-nav-icon
                        @click="drawer = !drawer"
                    ></v-app-bar-nav-icon>
                </div>
            </v-app-bar>
        </v-app-bar>
    </div>
</template>
<script>
import defaultCSS from "../default.js";
export default {
    props: ["auth_user"],
    data: function() {
        return {
            defaultCSS: defaultCSS,
            drawer: false
        };
    },
    methods: {
        logout: function() {
            axios.post("/logout").then(function() {
                location.href = "/login";
            });
        }
    }
};
</script>
