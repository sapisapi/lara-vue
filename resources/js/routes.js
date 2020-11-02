import Home from './components/Home';
import About from './components/About';
import Register from './components/Register';
import Login from './components/Login';
import List from './components/List';
import Dashboard from './components/Dashboard';
import Notfound from './components/Notfound';

import Axios from 'axios';



export default{
    mode: 'history',
    routes: [
        {
            path: '*',
            component: Notfound
        },
        {
            path: '/',
            component: Home,
            name: 'Home'
        },
        {
            path: '/about',
            component: About
        },
        {
            path: '/register',
            component: Register
        },
        {
            path: '/login',
            component: Login,
            name: 'Login'
        },
        {
            path: '/dashboard/:id',
            component: Dashboard,
            name: 'Dashboard',
           beforeEnter: (to, form, next) =>{
                axios.get('/api/authenticated').then(()=>{
                    next()
                }).catch(()=>{
                    return next({
                        name: 'Login'
                    })
                })
            }
        },
        {
            path: '/list',
            component: List,
            name: 'List',
           beforeEnter: (to, form, next) =>{
                axios.get('/api/authenticated').then(()=>{
                    next()
                }).catch(()=>{
                    return next({
                        name: 'Login'
                    })
                })
            }
        },
    ]
}