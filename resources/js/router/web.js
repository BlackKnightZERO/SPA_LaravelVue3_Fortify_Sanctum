
import Login from '../pages/auth/Login'
import Register from '../pages/auth/Register'

export default [
    {
        path: '/',
        name: 'spa.index',
        component: Login,
        meta : { auth : false }
    },
    {
        path: '/login',
        name: 'spa.login',
        component: Login,
        meta : { auth : false }
    },
    {
        path: '/register',
        name: 'spa.register',
        component: Register,
        meta : { auth : false }
    },
]