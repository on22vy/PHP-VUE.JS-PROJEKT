import { createApp } from 'vue'
import LogIn from './LogIn.vue'
import router from './router/router.js'


createApp(LogIn).use(router).mount('#app')