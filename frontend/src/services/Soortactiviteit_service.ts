import { ApiObject } from '@/api'
import Soortactiviteit from '@/models/Soortactiviteit'

export const getSoorten = (): ApiObject => ({
    url: '/soortactiviteiten',
    method: 'GET',
})