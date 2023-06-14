import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import { vMaska } from "maska"
import axios from 'axios'
import Vue3Toastify, { toast } from 'vue3-toastify'

import 'vue3-toastify/dist/index.css';
import '@coreui/coreui/dist/css/coreui.min.css'
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import "bootstrap-icons/font/bootstrap-icons.css"

const main = createApp(App)

main.directive("maska", vMaska).use(store).use(router).use(Vue3Toastify, {
    autoClose: 3000,
    position: toast.POSITION.BOTTOM_RIGHT,
    newestOnTop: true,
    theme: 'dark',
})

const http = axios.create({
    baseURL: 'http://127.0.0.1:8000/'
})

main.config.globalProperties.$http = http;
main.config.globalProperties.$toast = toast;

main.mount('#app')