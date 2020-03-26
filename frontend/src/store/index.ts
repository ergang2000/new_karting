import Vue from 'vue'
import Vuex from 'vuex'
import User from '@/models/User'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        user: undefined,
        token: undefined
    },
    mutations: {
        setUser(state: any, user: User) {
            state.user = user
        },
        setToken(state: any, token: string) {
            state.token = token
        }
    },
    actions: {
        login(context: any, { token, user }) {
            context.commit('setUser', user)
            context.commit('setToken', token)
        }
    },
    modules: {},
})
