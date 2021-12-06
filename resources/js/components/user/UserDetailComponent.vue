<template>
    <div>
        <v-content class="fill-height pt-0" red>
            <v-row justify="center" red>
                <v-col cols="12" sm="8" md="9" class="pb-0">
                    <div>
                        <v-avatar size="140px">
                            <v-img
                                v-if="user.img"
                                v-bind:src="'../storage/' + user.img"
                                aspect-ratio="1.7"
                            />
                            <v-img
                                v-else
                                v-bind:src="'../storage/no-image.png'"
                                aspect-ratio="1.7"
                            />
                        </v-avatar>
                        <h1 class="font-weight-bold ml-1 mt-4">
                            {{ user.name }}
                        </h1>
                        <p class="ml-1">{{ user.comment }}</p>
                        <v-container class="my-4">
                            <v-row :justify="'space-between'">
                                <v-col cols="6">
                                    <v-row>
                                        <v-btn
                                            class="button font-weight-bold"
                                            color="#FFD500"
                                            rounded
                                            :href="'/profileEdit'"
                                            min-width="150"
                                            >プロフィール編集</v-btn
                                        >
                                    </v-row>
                                </v-col>
                                <v-col cols="6">
                                    <v-row>
                                        <v-btn
                                            class="button font-weight-bold"
                                            color="#FFD500"
                                            rounded
                                            :href="'/addRecipe'"
                                            min-width="150"
                                            >レシピ追加</v-btn
                                        >
                                    </v-row>
                                </v-col>
                            </v-row>
                        </v-container>
                        <recipe
                            :auth_user="auth_user"
                            :recipe_list="recipes"
                        ></recipe>
                    </div>
                </v-col>
            </v-row>
        </v-content>
    </div>
</template>
<script>
import recipe from "../recipe/RecipeComponent.vue";
export default {
    props: ["auth_user", "recipes", "user"],
    components: {
        recipe: recipe
    },
    data: function() {
        return {};
    }
};
</script>
