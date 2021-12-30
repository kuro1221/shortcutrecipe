<template>
    <v-app>
        <v-content class="fill-height pt-0" fluid>
            <v-row justify="center">
                <v-col cols="12" sm="8" md="4">
                    <h2 class="page-title">退会</h2>
                    <p class="mt-4">
                        退会後は作成したショートカットのレシピが削除されますのでご注意ください。
                    </p>
                    <v-row justify="center">
                        <v-btn
                            class="button font-weight-bold my-5"
                            color="#FFD500"
                            rounded
                            large
                            @click="modalFlg = true"
                            >退会</v-btn
                        >
                    </v-row>
                </v-col>
                <v-dialog
                    v-model="modalFlg"
                    min-width="350"
                    max-width="600"
                    height="250"
                >
                    <v-card class="pa-3">
                        <v-card-text class="font-weight-bold">
                            本当に退会してもよろしいですか？
                        </v-card-text>
                        <v-card-actions class="mb-2">
                            <v-spacer></v-spacer>
                            <v-btn
                                class="button_small font-weight-bold"
                                color="#FFD500"
                                rounded
                                small
                                @click="withdrawal"
                                >はい</v-btn
                            >
                            <v-spacer></v-spacer>
                            <v-btn
                                class="button_small font-weight-bold"
                                color="#FFD500"
                                rounded
                                small
                                @click="modalFlg = false"
                                >いいえ</v-btn
                            >
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-row>
        </v-content>
    </v-app>
</template>
<script>
export default {
    props: ["props_auth_user"],
    data: function() {
        return {
            modalFlg: false
        };
    },
    methods: {
        withdrawal: function(e) {
            axios.post("withdrawal").then(function() {
                self.errors = [];
                location.href = "/";
            });
        }
    }
};
</script>
