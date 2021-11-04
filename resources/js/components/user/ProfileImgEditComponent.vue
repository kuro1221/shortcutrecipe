<template>
    <v-app>
        <v-content class="fill-height" fluid>
            <v-row justify="center">
                <v-col cols="12" sm="8" md="4">
                    <v-card class="elevation-12">
                        <v-toolbar color="primary" dark flat>
                            <v-toolbar-title
                                >プロフィール画像編集</v-toolbar-title
                            >
                            <v-spacer />
                        </v-toolbar>
                        <v-card-text>
                            <v-form ref="form">
                                <v-avatar v-if="preview_image" size="200px"
                                    ><v-img
                                        :src="preview_image"
                                        aspect-ratio="1.7"
                                        contain
                                /></v-avatar>
                                <v-avatar
                                    v-else-if="auth_user.img"
                                    size="200px"
                                >
                                    <v-img
                                        v-bind:src="
                                            '../storage/' + auth_user.img
                                        "
                                        aspect-ratio="1.7"
                                    />
                                </v-avatar>
                                <v-avatar v-else size="200px"
                                    ><v-img
                                        :src="'/../storage/no-image.png'"
                                        alt="Avatar"
                                        contain
                                /></v-avatar>
                                <v-file-input
                                    :rules="[rule.limit_image_size]"
                                    label="プロフィール画像"
                                    accept="image/*"
                                    show-size
                                    prepend-icon="far fa-image"
                                    v-on:change="file_selected"
                                    :error-messages="errors.img"
                                />
                            </v-form>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer />
                            <v-btn color="primary" @click="profileImgEdit"
                                >編集</v-btn
                            >
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </v-content>
    </v-app>
</template>
<script>
import validation_rule from "../../validation.js";
export default {
    props: ["props_auth_user"],
    data: function() {
        return {
            rule: validation_rule,
            auth_user: this.props_auth_user,
            file_info: "",
            preview_image: "",
            errors: {}
        };
    },
    methods: {
        profileImgEdit: function(e) {},
        file_selected: function(event) {
            this.file_info = event;
            if (this.file_info) {
                const reader = new FileReader();
                reader.onload = e => {
                    this.preview_image = e.target.result;
                };
                reader.readAsDataURL(this.file_info);
            }
        }
    }
};
</script>
