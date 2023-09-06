import RolesPermissionsToVue from "../../vendor/geowrgetudor/laravel-spatie-permissions-vue/src/js";
import './bootstrap';

import { createApp } from "vue";
import App from './src/App.vue'

const app = createApp(App)
app.use(RolesPermissionsToVue);
app.mount('#app')
