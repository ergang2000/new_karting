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
        removeUser(state: any) {
            state.user = undefined
        },
        setToken(state: any, token: string) {
            state.token = token
        },
        removeToken(state: any) {
            state.token = undefined
        },
    },
    actions: {
        login(context: any, { token, user }) {
            context.commit('setUser', user)
            context.commit('setToken', token)
        },

        logout(context: any) {
            context.commit('removeUser')
            context.commit('removeToken')
        }
    },
    modules: {},
})
