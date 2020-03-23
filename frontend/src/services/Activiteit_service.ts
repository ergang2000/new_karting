import { ApiObject } from '@/api'

export const getActiviteiten = (): ApiObject => ({
    url: '/activiteiten',
    method: 'GET',
})