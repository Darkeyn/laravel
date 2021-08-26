require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

window.Vue = require('vue').default;

import App from './components/App'
import Home from './components/Home'
import UsersList from './components/UsersList'
import Register from './components/Register'
import Login from './components/Login'
import ShowProject from './components/ShowProject'
import ShowUser from './components/ShowUser'
import ProjectView from './components/ProjectView'
import NewProject from './components/NewProject'
import axios from 'axios';


Vue.component('v-header', require('./components/Header.vue').default);

const router = new VueRouter({
    mod:'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            beforeEnter: (to, form, next) =>{
                axios.get('/api/auth').then(()=>{
                    next()
                }).catch(()=>{
                    return next({name: 'login'})
                })
            }
        },
        {
            path: '/userslist',
            name: 'userslist',
            component: UsersList,
            beforeEnter: (to, form, next) =>{
                axios.get('/api/auth').then(()=>{
                    next()
                }).catch(()=>{
                    return next({name: 'login'})
                })
            }
        },
        {
            path: '/project/:projectId',
            name: 'showProject',
            component: ShowProject,
            props: true,
        },
        {
            path: '/projectedit/:projectId',
            name: 'ProjectView',
            component: ProjectView,
            props: true,
        },
        {
            path: '/user/:userId',
            name: 'showUser',
            component: ShowUser,
            props: true,
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/newproject',
            name: 'newProject',
            component: NewProject
        },

    ]
})


const app = new Vue({
    el: '#app',
    components: {App},
    router
});
