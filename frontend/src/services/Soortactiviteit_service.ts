import { ApiObject } from '@/api'
import Soortactiviteit from '@/models/Soortactiviteit'

export const getSoort = (): ApiObject => ({
    url: '/soortactiviteiten',
    method: 'GET',
})