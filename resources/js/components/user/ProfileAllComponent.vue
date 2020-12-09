<template>
  <v-app>
    <v-content class="fill-height" fluid>
      <v-row justify="center">
        <v-col cols="12" sm="8" md="4">
          <v-card class="elevation-12">
            <passwordEdit :props_auth_user="props_auth_user"></passwordEdit>
            <profileEdit :props_auth_user="props_auth_user"></profileEdit>
          </v-card>
        </v-col>
      </v-row>
    </v-content>
  </v-app>
</template>
<script>
import profileEdit from '../user/ProfileEditComponent.vue';
import profileImgEdit from '../user/ProfileImgEditComponent.vue';
import passwordEdit from '../user/PasswordEditComponent.vue';

export default {
  props: ["props_auth_user"],
  components: {
      'profileEdit': profileEdit,
      'profileImgEdit ': profileImgEdit,
      'passwordEdit': passwordEdit,
  },
  data: function() {
    return {

    }
  },
}
</script>
