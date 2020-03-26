import { ApiObject } from '@/api'

export const getActiviteiten = (): ApiObject => ({
    url: '/activiteiten',
    method: 'GET',
})

export const getBeschikbareActiviteiten = (): ApiObject => ({
    url: '/user/activiteiten/beschikbaar',
    method: 'GET'
})

export const getIngeschrevenActiviteiten = (): ApiObject => ({
    url: '/user/activiteiten/ingeschreven',
    method: 'GET'
})

export const inschrijven = (id: number | string): ApiObject => ({
    url: `/user/activiteiten/${id}/inschrijven`,
    method: 'PUT'
})

export const uitschrijven = (id: number | string): ApiObject => ({
    url: `/user/activiteiten/${id}/uitschrijven`,
    method: 'PUT'
})
