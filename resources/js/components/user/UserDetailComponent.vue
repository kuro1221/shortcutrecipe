<template>
    <div>
        <v-content class="fill-height pt-0" red >
            <v-row justify="center" red>
                <v-col cols="12" sm="8" md="9" class="pb-0">
                    <div>
                        <v-avatar size="120px">
                            <v-img
                                v-if="user.img"
                                v-bind:src="'../storage/' + user.img"
                                aspect-ratio="1.7"
                                contain
                            />
                            <v-img
                                v-else
                                v-bind:src="'../storage/no-image.png'"
                                aspect-ratio="1.7"
                                contain
                            />
                        </v-avatar>
                    </div>
                </v-col>
            </v-row>
            <h1 class="font-weight-bold ml-1">{{ user.name }}</h1>
            <p class="ml-1">{{ user.comment }}</p>
            <v-row justify="center" red>
                <recipe :auth_user="auth_user" :recipe_list="recipes"></recipe>
            </v-row>
        </v-content>
    </div>
</template>
<script>
import recipe from '../recipe/RecipeComponent.vue';
export default {
    props: ["auth_user","recipes","user"],
    components: {
        'recipe': recipe
    },
    data: function() {
        return {
        }
    },
}
</script>