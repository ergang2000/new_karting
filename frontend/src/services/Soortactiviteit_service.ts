import { ApiObject } from '@/api'
import Soortactiviteit from '@/models/Soortactiviteit'

export const getSoorten = (): ApiObject => ({
    url: '/soortactiviteiten',
    method: 'GET',
})

export const getSoort = (id: string): ApiObject => ({
    url: `/soortactiviteiten/${id}`,
    method: 'GET'
})
