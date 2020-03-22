import Vue from 'vue'
import Vuex from 'vuex'
import User from '@/models/User'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: new User()
    },
    mutations: {},
    actions: {},
    modules: {},
})
