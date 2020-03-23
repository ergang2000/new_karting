import { getApiUrl } from '@/constants';

declare type method = 'POST' | 'GET' | 'PUT' | 'DELETE';

export interface ApiObject {
    url: string;
    method: method;
    parameters?: object;
}

const url = getApiUrl();

export function call(api: ApiObject): Promise<any> {
    const body = new FormData();

    if (api.parameters) {
        const keys = Object.keys(api.parameters);

        for (const key in keys) {
            // @ts-ignore
            body.append(key, api.parameters[key]);
        }
    }

    if (api.method === 'GET') {
        return fetch(url + api.url, {
            method: api.method.toLowerCase(),
        }).then(res => {
            return res.json() as Promise<any>
        });
    }

    return fetch(url + api.url, {
        method: api.method,
        body
    }).then(res => {
        return res.json() as Promise<any>
    });
}
