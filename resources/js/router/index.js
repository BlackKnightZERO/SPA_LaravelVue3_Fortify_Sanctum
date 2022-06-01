import { createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from '../store/authState'
import WebRoutes from './web.js'

import Dashboard from '../pages/dashboard/Dashboard'
import Add from '../pages/dashboard/Add'

const routes = [

    ...WebRoutes,
    
    {
        path: '/dashboard',
        name: 'spa.dashboard',
        component: Dashboard,
        meta : { auth : true }
    },
    {
        path: '/add',
        name: 'spa.add',
        component: Add,
        meta : { auth : true }
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if( to.meta.auth && !useAuthStore().$state.isAutheticated ) {
        next({ name: 'spa.login' })
    } else if( !to.meta.auth && useAuthStore().$state.isAutheticated ) {
        next({ name: 'spa.dashboard' })
    } else {
        next()
    }
})

export default router
