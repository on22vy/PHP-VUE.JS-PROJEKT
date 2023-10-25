import { createRouter, createWebHistory} from "vue-router";
import Home from '../views/Home.vue'
import DeletedFiles from '../views/DeletedFiles.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: Home
        },
        {
            path: '/deletedFiles',
            component: DeletedFiles
        }
    ]
    
})

export default router