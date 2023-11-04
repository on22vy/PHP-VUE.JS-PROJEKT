import { createRouter, createWebHistory} from "vue-router";
import Home from '../views/Home.vue'
import DeletedFilesPage from '../views/DeletedFilesPage.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: Home
        },
        {
            path: '/deletedFiles',
            component: DeletedFilesPage
        }
    ]
    
})

export default router