<template>
  <v-app>
    <v-content class="fill-height" fluid>
      <v-row justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-card class="elevation-12">
            <v-toolbar color="primary" dark flat>
              <v-toolbar-title>パスワード編集</v-toolbar-title>
              <v-spacer />
            </v-toolbar>
            <v-card-text>
              <v-form ref="form">
                <v-text-field
                  v-model="old_password"
                  label="古いパスワード"
                  name="old_password"
                  prepend-icon="fas fa-utensils"
                  type="password"
                  :rules="[rule.required, rule.limit_min_length,rule.limit_max_length]"
                  :error-messages="errors.old_password"
                />
                <v-text-field
                  v-model="password"
                  label="新しいパスワード"
                  name="password"
                  prepend-icon="fas fa-utensils"
                  type="password"
                  :rules="[rule.required, rule.limit_min_length,rule.limit_max_length]"
                  :error-messages="errors.password"
                />
                <v-text-field
                  v-model="password_confirmation"
                  label="新しいパスワード(再)"
                  name="password_confirmation"
                  prepend-icon="fas fa-utensils"
                  type="password"
                  :rules="[rule.required, rule.limit_min_length,rule.limit_max_length]"
                  :error-messages="errors.password_confirmation"
                />
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer />
              <v-btn color="primary" @click="passwordEdit">編集</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-content>
  </v-app>
</template>
<script>
import validation_rule from '../../validation.js'
export default {
  props: ["props_auth_user"],
  data: function() {
    return {
      rule: validation_rule,
      auth_user: this.props_auth_user,
      old_password: '',
      password: '',
      password_confirmation: '',
      errors: {
        old_password: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  methods: {
    passwordEdit: function(e) {
      if(this.$refs.form.validate()){
        let self = this;
        self.errors = {
            old_password: '',
            password: '',
            password_confirmation: ''
        }
        axios.post('/passwordEdit',{
            old_password: this.old_password,
            password: this.password,
            password_confirmation: this.password_confirmation,
        }
        ).then(function(){
          self.errors = [];
          location.href = '/home'
        }).catch(function(error){
          for(let key in error.response.data.errors) {
            self.errors[key] = error.response.data.errors[key][0];
          }
        });
      }
    },
  },
}
</script>
