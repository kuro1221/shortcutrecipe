<template>
    <v-app>
        <v-content class="fill-height pt-0" fluid>
            <v-row justify="center">
                <v-col cols="12" sm="8" md="4">
                    <h2 class="page-title">レシピ編集</h2>
                    <v-form ref="form">
                        <v-text-field
                            v-model="recipe.recipe_name"
                            label="レシピ名（必須）"
                            name="recipe_name"
                            prepend-icon="fas fa-font"
                            type="text"
                            :rules="[rule.required, rule.limit_max_name]"
                            :error-messages="errors.recipe_name"
                        />
                        <v-text-field
                            v-model="recipe.iCloud_link"
                            label="iCloudリンク（必須）"
                            name="iCloud_link"
                            prepend-icon="fab fa-apple"
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
                            prepend-icon="fas fa-mobile-alt"
                        ></v-select>
                        <v-select
                            v-model="recipe.select_application"
                            :items="application_list"
                            item-text="application_name"
                            item-value="id"
                            multiple
                            label="対象アプリ(複数選択可能)"
                            prepend-icon="fas fa-database"
                        ></v-select>
                        <v-text-field
                            v-model="recipe.reference_title"
                            label="参考物タイトル"
                            name="reference_title"
                            prepend-icon="fas fa-font"
                            type="text"
                            :rules="[rule.limit_max_name]"
                            :error-messages="errors.reference_title"
                        />
                        <v-text-field
                            v-model="recipe.reference_url"
                            label="参考URL"
                            name="reference_url"
                            prepend-icon="fas fa-paperclip"
                            type="text"
                            :rules="[rule.limit_max_link]"
                            :error-messages="errors.reference_url"
                        />
                        <v-textarea
                            v-model="recipe.comment"
                            label="コメント"
                            autocomplete="comment"
                            prepend-icon="far fa-comment"
                            :rules="[rule.limit_max_comment]"
                            counter="200"
                            :error-messages="errors.comment"
                        ></v-textarea>
                    </v-form>
                    <v-row justify="center">
                        <v-btn
                            class="button font-weight-bold my-5"
                            color="#FFD500"
                            rounded
                            large
                            @click="editRecipe"
                            >更新</v-btn
                        >
                    </v-row>
                </v-col>
            </v-row>
        </v-content>
    </v-app>
</template>
<script>
import validation_rule from "../../validation";
export default {
    props: [
        "props_recipe",
        "props_select_application",
        "props_select_product",
        "application_list",
        "product_list"
    ],
    data: function() {
        return {
            rule: validation_rule,
            recipe: "",
            errors: {}
        };
    },
    created: function() {
        this.recipe = this.props_recipe;
        this.recipe.select_application = [];
        this.recipe.select_product = [];
        for (let i = 0; i < this.props_select_product.length; i++) {
            this.recipe.select_product.push(this.props_select_product[i].id);
        }
        for (let i = 0; i < this.props_select_application.length; i++) {
            this.recipe.select_application.push(
                this.props_select_application[i].id
            );
        }
    },
    methods: {
        editRecipe: function(e) {
            if (this.$refs.form.validate()) {
                let self = this;
                self.errors = {
                    recipe_name: "",
                    iCloud_link: "",
                    comment: "",
                    reference_title: "",
                    reference_url: ""
                };
                axios
                    .post("/editRecipe/" + this.recipe.id, this.recipe)
                    .then(function() {
                        self.errors = [];
                        location.href = "/";
                    })
                    .catch(function(error) {
                        for (let key in error.response.data.errors) {
                            self.errors[key] =
                                error.response.data.errors[key][0];
                        }
                    });
            }
        }
    }
};
</script>
