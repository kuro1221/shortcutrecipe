<template>
  <v-app>
    <v-content class="fill-height pt-0" fluid>
      <v-row justify="center">
        <v-col cols="12" sm="8" md="4">
            <h2 class="page-title">ログイン</h2>
            <v-form ref="form">
               <v-text-field
                  class="font-weight-bold"
                  v-model="email"
                  label="Eメール"
                  name="email"
                  prepend-icon="fas fa-envelope"
                  type="text"
                  :rules="[rule.required, rule.limit_max_length,rule.email]"
                  :error-messages="errors.email"
                />
                <v-text-field
                  class="font-weight-bold"
                  v-model="password"
                  label="パスワード"
                  name="password"
                  prepend-icon="fas fa-key"
                  type="password"
                  :rules="[rule.required,rule.limit_max_length]"
                  :error-messages="errors.password"
                />
            </v-form>
            <v-row justify="center">
                <v-btn class="button font-weight-bold my-5" color="#FFD500" rounded large v-on:click="login">ログイン</v-btn>
                <a class="btn btn-link" href="password/reset">
                    パスワードを忘れた方
                </a>
                <a href="linelogin">LINEログイン</a>
            </v-row>
        </v-col>
      </v-row>
    </v-content>
  </v-app>
</template>
<script>
import validation_rule from '../../validation.js'
export default {
  data: function() {
    return {
        rule: validation_rule,
        email: '',
        password: '',
        errors: {
        }
    }
  },
  methods: {
    login: function(e) {
      if(this.$refs.form.validate()){
        let self = this;
        self.errors = {
            email: '',
            password:'',
        }
        axios.post('/login',{
            email:this.email,
            password: this.password
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
