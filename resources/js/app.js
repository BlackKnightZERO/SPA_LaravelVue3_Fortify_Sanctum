require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import router from './router'

import AppLayout from './layouts/AppLayout.vue'

const app = createApp({
    components: {
        AppLayout
    }
})

const pinia = createPinia()
pinia.use(piniaPluginPersistedstate)
app.use(router)
app.use(pinia)

router.isReady().then(() => {
    app.mount('#app')
})

// app.mount('#app')
