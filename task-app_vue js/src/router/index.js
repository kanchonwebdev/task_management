import { createWebHistory, createRouter } from 'vue-router'

import DashboardPage from '@/pages/DashboardPage.vue';
import LoginPage from '@/pages/LoginPage.vue';
import RegisterPage from '@/pages/RegisterPage.vue';
import TaskcreatePage from '@/pages/TaskcreatePage.vue';
import TaskPage from '@/pages/TaskPage.vue';
import TaskupdatePage from '@/pages/TaskupdatePage.vue';
import TaskviewPage from '@/pages/TaskviewPage.vue';

const isAuthenticated = () => localStorage.getItem('isAuthenticated') === 'true';
const routes = [
    { path: '/', component: DashboardPage },
    { path: '/login', component: LoginPage },
    { path: '/register', component: RegisterPage },
    { path: '/task/create', component: TaskcreatePage },
    { path: '/task/index', component: TaskPage },
    { path: '/task/update/:id', component: TaskupdatePage },
    { path: '/task/view/:id', component: TaskviewPage },
    { path: '/logout', component: null },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
})


router.beforeEach((to, from, next) => {
    if (to.path === '/logout') {
        localStorage.removeItem('isAuthenticated'); // Clear auth state
        next('/login'); // Redirect to login
        return; // Stop further execution
    }
    
    if (isAuthenticated()) {
        if (to.path === '/login' || to.path === '/register') {
            next('/');
        } else {
            next();
        }
    } else {
        if (to.path !== '/login' && to.path !== '/register') {
            next('/login');
        } else {
            next();
        }
    }
});

export default router;