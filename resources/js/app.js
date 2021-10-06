import Vuetify from "vuetify";
import "vuetify/dist/vuetify.min.css";
// import "material-design-icons-iconfont/dist/material-design-icons.css";
import "@fortawesome/fontawesome-free/css/all.css";

require("./bootstrap");

window.Vue = require("vue");
Vue.use(Vuetify);

Vue.component(
    "guest-header-component",
    require("./components/GuestHeaderComponent.vue").default
);

Vue.component(
    "auth-header-component",
    require("./components/AuthHeaderComponent.vue").default
);

Vue.component(
    "login-component",
    require("./components/auth/LoginComponent.vue").default
);

Vue.component(
    "register-component",
    require("./components/auth/RegisterComponent.vue").default
);

Vue.component(
    "forget-password-component",
    require("./components/auth/ForgetPasswordComponent.vue").default
);

Vue.component(
    "reset-password-component",
    require("./components/auth/ResetPasswordComponent.vue").default
);

Vue.component(
    "profile-edit-component",
    require("./components/user/ProfileEditComponent.vue").default
);

Vue.component(
    "user-detail-component",
    require("./components/user/UserDetailComponent.vue").default
);

Vue.component(
    "password-edit-component",
    require("./components/user/PasswordEditComponent.vue").default
);

Vue.component(
    "withdrawal-component",
    require("./components/user/WithdrawalComponent.vue").default
);

Vue.component(
    "add-recipe-component",
    require("./components/recipe/AddRecipeComponent.vue").default
);

Vue.component(
    "add-recipe-component",
    require("./components/recipe/AddRecipeComponent.vue").default
);

Vue.component(
    "edit-recipe-component",
    require("./components/recipe/EditRecipeComponent.vue").default
);

Vue.component(
    "recipe-list-component",
    require("./components/recipe/RecipeListComponent.vue").default
);

const app = new Vue({
    el: "#app",
    vuetify: new Vuetify({
        background: "#BFDCFA"
    })
});

// フラッシュメッセージのfadeout
setTimeout(function() {
    $(".js-flash").fadeOut();
}, 3000);
