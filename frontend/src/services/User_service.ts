import { ApiObject } from '@/api'
import User from '@/models/User'

export const registerUser = (user: User): ApiObject => ({
    url: '/registreren',
    method: 'POST',
    parameters: user
})