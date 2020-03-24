import { getApiUrl } from '@/constants'

declare type method = 'POST' | 'GET' | 'PUT' | 'DELETE'

export interface ApiObject {
    url: string
    method: method
    parameters?: object
}

const url = getApiUrl()

export function call(api: ApiObject) {
    // const body: FormData = new FormData()
    let body = '{}'

    if (api.parameters) {
        // Object.keys(api.parameters).forEach(key => body.append(key, api.parameters[key]));
        body = JSON.stringify(api.parameters)
    }

    if (api.method === 'GET') {
        return fetch(url + api.url, {
            method: api.method.toLowerCase(),
        }).then(res => {
            return res.json()
        })
    }

    return fetch(url + api.url, {
        method: api.method,
        body
    }).then(res => {
        return res.json()
    })
}
