import './bootstrap'

import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/dist/sweetalert2.css'

window.Swal = Swal;
const toast = Swal.mixin({
    toast:true,
    position:'top-end',
    showConfirmButton:false,
    timer:3000,
    timerProgressBar:true,
})
window.toast = toast;

import router from './router/index.js'
import {createApp} from "vue"
import App from "./components/App.vue"
import {createPinia} from "pinia";
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

const pinia = createPinia();

createApp(App).use(router).use(pinia.use(piniaPluginPersistedstate)).mount("#app")




