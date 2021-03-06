import { ApiObject } from '@/api'
import User from '@/models/User'

export const registerUser = (user: User): ApiObject => ({
    url: '/registreren',
    method: 'POST',
    parameters: user
})

export const loginCall = (username: string, password: string): ApiObject => ({
    url: '/login_check',
    method: 'POST',
    parameters: { username, password }
})

export const getUser = (token?: string): ApiObject => ({
    url: '/user',
    method: 'GET',
    headers: token ? {
        Authorization: `Bearer ${token}`
    } : undefined
})

export const updateProfile = (user: User): ApiObject => ({
    url: '/user/profile',
    method: 'PUT',
    parameters: user
})

export const updatePassword = (password: string): ApiObject => ({
    url: '/user/password',
    method: 'PUT',
    parameters: { password }
})
