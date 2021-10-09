<template>
  <v-app>
    <v-content class="fill-height pt-0" fluid>
      <v-row justify="center">
        <v-col cols="12" sm="8" md="4">    
          <h2 class="page-title">パスワード変更</h2>
          <v-form ref="form">
            <v-text-field
              class="font-weight-bold"
              v-model="old_password"
              label="古いパスワード"
              name="old_password"
              prepend-icon="fas fa-key"
              type="password"
              hint="※8文字以上入力する必要があります"
              persistent-hint
              :rules="[rule.required,rule.limit_max_length]"
              :error-messages="errors.old_password"
            />
            <v-text-field
              class="font-weight-bold"
              v-model="password"
              label="新しいパスワード"
              name="password"
              prepend-icon="fas fa-key"
              type="password"
              hint="※8文字以上入力する必要があります"
              persistent-hint
              :rules="[rule.required,rule.limit_max_length]"
              :error-messages="errors.password"
            />
            <v-text-field
              class="font-weight-bold"
              v-model="password_confirmation"
              label="新しいパスワード(再)"
              name="password_confirmation"
              prepend-icon="fas fa-key"
              type="password"
              hint="※8文字以上入力する必要があります"
              persistent-hint
              :rules="[rule.required,rule.limit_max_length]"
              :error-messages="errors.password_confirmation"
            />
          </v-form>
          <v-row justify="center">
            <v-btn class="button font-weight-bold my-5" color="#FFD500" rounded large @click="passwordEdit">編集</v-btn>
          </v-row>
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
          location.href = '/'
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
