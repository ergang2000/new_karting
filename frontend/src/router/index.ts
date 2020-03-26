import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/bezoeker/Home.vue'
import Aanbod from '../views/bezoeker/Aanbod.vue'
import Activiteiten from '../views/bezoeker/Activiteiten.vue'
import Registreren from '../views/bezoeker/Registreren.vue'
import AanbodDetails from '../views/bezoeker/AanbodDetails.vue'
import Login from '../views/Login.vue'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/kartactiviteiten',
        name: 'Aanbod',
        component: Aanbod
    },
    {
        path: '/kartactiviteiten/:id',
        name: 'AanbodDetails',
        component: AanbodDetails
    },
    {
        path: '/activiteiten',
        name: 'Activiteiten',
        component: Activiteiten
    },
    {
        path: '/registreren',
        name: 'Registreren',
        component: Registreren
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
})

export default router
