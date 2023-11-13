/**
 * @author Thi Tuong Vy Nguyen <thi.nguyen.22@lehre.mosbach.dhbw.de>
 */
import { createRouter, createWebHistory} from "vue-router";
import Login from '../views/Login.vue'
import Home from '../views/Home.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: 'Login',
            path: '/',
            component: Login
        },
        {
            name: 'Home',
            path: '/home',
            component: Home
        },
        
    ]
    
})

export default router