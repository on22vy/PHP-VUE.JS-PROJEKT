/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
import { createApp } from 'vue'
import LogIn from './views/LogIn.vue'
import router from './router/router.js'


createApp(LogIn).use(router).mount('#app')