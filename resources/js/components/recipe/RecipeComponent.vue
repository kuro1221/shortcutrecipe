<template>
    <div>
        <v-layout wrap>
            <recipeModal
                :auth_user="auth_user"
                :recipe="recipeDetail"
                @reset="resetRecipe"
                v-show="modalFlg"
            ></recipeModal>
            <v-flex
                xs6
                md6
                shrink
                v-for="(recipe, i) in sliceRecipes"
                :key="i"
                class="no-border"
            >
                <v-row justify="space-around" class="pt-0">
                    <v-card
                        class="mx-1 mt-2 mb-4 card"
                        outlined
                        tile
                        height="120"
                    >
                        <v-list-item three-line class="px-2">
                            <v-list-item-content class="py-2">
                                <v-list-item-title
                                    class="subtitle-1 font-weight-bold"
                                >
                                    {{ recipe.recipe_name }}
                                </v-list-item-title>
                                <v-card-text
                                    class="pa-0 my-1 button text--secondary card_comment"
                                    height="60"
                                >
                                    {{ recipe.comment }}
                                </v-card-text>
                                <v-card-actions class="pa-0">
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        class="button_small"
                                        color="#FFD500"
                                        rounded
                                        small
                                        v-on:click="showModal(recipe)"
                                        >詳細</v-btn
                                    >
                                </v-card-actions>
                            </v-list-item-content>
                        </v-list-item>
                    </v-card>
                </v-row>
            </v-flex>
        </v-layout>
        <!-- ページネーション -->
        <v-row justify="center" class="my-4" red>
            <paginate
                :page-count="getPageCount"
                :page-range="3"
                :margin-pages="2"
                :click-handler="clickCallback"
                :prev-text="'<'"
                :prev-link-class="'page__prev'"
                :next-text="'>'"
                :next-link-class="'page__next'"
                :container-class="'pagination'"
                :page-class="'page__item'"
                :page-link-class="'page__item-link'"
                :hide-prev-next="true"
            ></paginate>
        </v-row>
    </div>
</template>
<script>
import Paginate from "vuejs-paginate";
import recipeModal from "../recipe/RecipeModalComponent.vue";
Vue.component("paginate", Paginate);
export default {
    props: ["auth_user", "recipe_list"],
    components: {
        recipeModal: recipeModal
    },
    data: function() {
        return {
            perPage: 8, //1ページあたりの表示商品数
            currentPage: 1,
            recipeDetail: "",
            modalFlg: false
        };
    },
    methods: {
        //現在のページ数を取得（ページネーション用)
        clickCallback: function(pageNum) {
            this.currentPage = Number(pageNum);
        },
        showModal: function(recipe) {
            this.recipeDetail = recipe;
            this.modalFlg = true;
        },
        resetRecipe: function() {
            this.recipeDetail = "";
            this.modalFlg = false;
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
};
</script>
