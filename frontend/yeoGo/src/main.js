import './assets/main.css'
import App from './App.vue'
import router from './router'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

const app = createApp(App)
const pinia = createPinia();
import VueGoogleMaps from '@fawmi/vue-google-maps'
app.use(pinia)
app.use(router)
app.use(VueGoogleMaps, {
    load:{
        key: 'AIzaSyCAqdwRPpTtDGc6lWZKlSO0EPgkAKRo-8o',
        libraries: "places"
        // 2H 11
    }
})
app.mount('#app')
