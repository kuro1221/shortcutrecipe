<template>
    <v-app>
        <v-content class="fill-height pt-0" fluid>
            <v-row justify="center">
                <v-col cols="12" sm="8" md="4">
                    <h2 class="page-title">プロフィール編集</h2>
                    <v-form ref="form" class="mt-4">
                        <v-row justify="center">
                            <v-avatar v-if="preview_image" size="200px"
                                ><v-img :src="preview_image" aspect-ratio="1.7"
                            /></v-avatar>
                            <v-avatar v-else-if="auth_user.img" size="200px">
                                <v-img
                                    v-bind:src="'../storage/' + auth_user.img"
                                    aspect-ratio="1.7"
                                />
                            </v-avatar>
                            <v-avatar v-else size="200px"
                                ><v-img
                                    :src="'/../storage/no-image.png'"
                                    alt="Avatar"
                            /></v-avatar>
                        </v-row>
                        <v-file-input
                            class="font-weight-bold"
                            :rules="[rule.limit_image_size]"
                            label="プロフィール画像"
                            accept="image/*"
                            show-size
                            prepend-icon="far fa-image"
                            v-on:change="file_selected"
                            :error-messages="errors.img"
                        />
                        <v-text-field
                            class="font-weight-bold"
                            v-model="auth_user.email"
                            label="e-mail（必須）"
                            name="email"
                            prepend-icon="far fa-envelope"
                            type="text"
                            :rules="[rule.required, rule.limit_max_length]"
                            :error-messages="errors.email"
                        />
                        <v-text-field
                            class="font-weight-bold"
                            v-model="auth_user.name"
                            label="名前（必須）"
                            name="name"
                            prepend-icon="far fa-user"
                            type="text"
                            :rules="[rule.required, rule.limit_max_name]"
                            :error-messages="errors.name"
                        />
                        <v-textarea
                            class="font-weight-bold"
                            v-model="auth_user.comment"
                            label="コメント"
                            autocomplete="comment"
                            prepend-icon="far fa-comment"
                            :rules="[rule.limit_max_comment]"
                            counter="200"
                        ></v-textarea>
                    </v-form>
                    <v-row justify="center">
                        <v-btn
                            class="button font-weight-bold my-5"
                            color="#FFD500"
                            rounded
                            large
                            @click="profileEdit"
                            >更新</v-btn
                        >
                    </v-row>
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
        profileEdit: function(e) {
            if (this.$refs.form.validate()) {
                let self = this;
                self.errors = {
                    name: "",
                    email: "",
                    comment: ""
                };
                //画像を送信するためformData使用
                const formData = new FormData();
                formData.append("img", self.file_info);
                formData.append("name", self.auth_user.name);
                formData.append("email", self.auth_user.email);
                formData.append("comment", self.auth_user.comment);

                axios
                    .post("/profileEdit", formData)
                    .then(function() {
                        self.errors = [];
                        location.href = "/recipeList";
                    })
                    .catch(function(error) {
                        for (let key in error.response.data.errors) {
                            self.errors[key] =
                                error.response.data.errors[key][0];
                        }
                    });
            }
        },
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
