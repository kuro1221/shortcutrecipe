/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import '@fortawesome/fontawesome-free/css/all.css'

require("./bootstrap");

window.Vue = require("vue");
Vue.use(Vuetify);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

Vue.component(
    "header-component",
    require("./components/HeaderComponent.vue").default
);

Vue.component(
    "profile-all-component",
    require("./components/user/ProfileAllComponent.vue").default
);
Vue.component(
    "user-detail-component",
    require("./components/user/UserDetailComponent.vue").default
);
Vue.component(
    'add-recipe-component',
    require("./components/recipe/AddRecipeComponent.vue").default
);

Vue.component(
    'edit-recipe-component',
    require("./components/recipe/EditRecipeComponent.vue").default
);

Vue.component(
    'recipe-list-component',
    require("./components/recipe/RecipeListComponent.vue").default
);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    vuetify: new Vuetify({
        background: "#BFDCFA"
    }),
});

