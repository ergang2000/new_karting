import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/bezoeker/Home.vue'
import Aanbod from '../views/bezoeker/Aanbod.vue'

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
    }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes,
})

export default router
