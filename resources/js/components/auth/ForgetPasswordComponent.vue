<template>
    <v-app>
        <v-content class="fill-height pt-0" fluid>
            <v-row justify="center">
                <v-col cols="12" sm="8" md="4">
                    <h2 class="page-title">パスワードリセット</h2>
                    <v-form ref="form" class="mt-4">
                        <span
                            >パスワードをリセットするためのメールが送信されます。</span
                        >
                        <v-text-field
                            class="font-weight-bold"
                            v-model="email"
                            label="Eメール（必須）"
                            name="email"
                            prepend-icon="fas fa-envelope"
                            type="text"
                            :rules="[
                                rule.required,
                                rule.limit_max_length,
                                rule.email
                            ]"
                            :error-messages="errors.email"
                        />
                    </v-form>
                    <v-row justify="center">
                        <v-btn
                            class="button font-weight-bold my-5"
                            color="#FFD500"
                            rounded
                            large
                            v-on:click="resetPassword"
                            >メールを送信する</v-btn
                        >
                        <span v-if="showMessage">メールを送信しました。</span>
                    </v-row>
                </v-col>
            </v-row>
        </v-content>
    </v-app>
</template>
<script>
import validation_rule from "../../validation.js";
export default {
    data: function() {
        return {
            rule: validation_rule,
            email: "",
            showMessage: false,
            errors: {}
        };
    },
    methods: {
        resetPassword: function(e) {
            if (this.$refs.form.validate()) {
                let self = this;
                self.errors = {
                    email: ""
                };
                axios
                    .post("email", {
                        email: this.email
                    })
                    .then(function() {
                        self.errors = [];
                        self.showMessage = true;
                    })
                    .catch(function(error) {
                        console.log("error発生?");
                        console.log(error);
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
