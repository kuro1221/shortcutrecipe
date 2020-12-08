<template>
  <v-app>
    <v-content class="fill-height" fluid>
      <v-row justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-card class="elevation-12">
            <v-toolbar color="primary" dark flat>
              <v-toolbar-title>プロフィール編集</v-toolbar-title>
              <v-spacer />
            </v-toolbar>
            <v-card-text>
              <v-form ref="form">
                <v-text-field
                  v-model="auth_user.email"
                  label="e-mail"
                  name="email"
                  prepend-icon="fas fa-utensils"
                  type="text"
                  :rules="[rule.required, rule.limit_max_length,rule.email]"
                  :error-messages="errors.email"
                />
                <v-text-field
                  v-model="auth_user.name"
                  label="名前"
                  name="name"
                  prepend-icon="fas fa-utensils"
                  type="text"
                  :rules="[rule.required, rule.limit_max_length]"
                  :error-messages="errors.name"
                />
                <v-text-field
                  v-model="auth_user.twitter"
                  label="Twitter_id"
                  name="twitter"
                  prepend-icon="fas fa-utensils"
                  type="text"
                  :rules="[rule.limit_max_length]"
                  :error-messages="errors.twitter"
                />
                <v-text-field
                  v-model="auth_user.youtube"
                  label="youtube_id"
                  name="youtube"
                  prepend-icon="fas fa-utensils"
                  type="text"
                  :rules="[rule.limit_max_length]"
                  :error-messages="errors.youtube"
                />
                <v-text-field
                  v-model="auth_user.website"
                  label="website_id"
                  name="website"
                  prepend-icon="fas fa-utensils"
                  type="text"
                  :rules="[rule.limit_max_length]"
                  :error-messages="errors.website"
                />
                <v-text-field
                  v-model="auth_user.instaglam"
                  label="instaglam_id"
                  name="instaglam"
                  prepend-icon="fas fa-utensils"
                  type="text"
                  :rules="[rule.limit_max_length]"
                  :error-messages="errors.instaglam"
                />
                <v-textarea
                  v-model="auth_user.comment"
                  label="コメント"
                  autocomplete="comment"
                  prepend-icon="far fa-comment"
                  :rules="[rule.limit_max_comment]"
                  counter="200"
                ></v-textarea>
              </v-form>
            </v-card-text>
            <v-card-actions>
              <v-spacer />
              <v-btn color="primary" @click="profileEdit">編集</v-btn>
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
      errors: {
      }
    }
  },
  methods: {
    profileEdit: function(e) {
      if(this.$refs.form.validate()){
        let self = this;
        self.errors = {
          name: '',
          email: '',
          comment: '',
          instaglam: '',
          twitter: '',
          website: '',
          youtube: '',
        }
        axios.post('/profileEdit',this.auth_user
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
