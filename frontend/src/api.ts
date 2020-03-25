import { getApiUrl } from '@/constants'
import { Vue } from 'vue-property-decorator'
import { ComponentOptions } from 'vue'
import { $internalHooks } from 'vue-class-component/lib/component'

declare type method = 'POST' | 'GET' | 'PUT' | 'DELETE'

export interface ApiObject {
    url: string
    method: method
    parameters?: object
}

const apiUrl = getApiUrl()

const mixin: ComponentOptions<Vue> = {
    methods: {
        $call(api: ApiObject) {
            // const body: FormData = new FormData()
            let body = '{}'

            if (api.parameters) {
                // Object.keys(api.parameters).forEach(key => body.append(key, api.parameters[key]));
                body = JSON.stringify(api.parameters)
            }

            if (api.method === 'GET') {
                return fetch(apiUrl + api.url, {
                    method: api.method.toLowerCase(),
                }).then(res => {
                    return res.json()
                })
            }

            return fetch(apiUrl + api.url, {
                method: api.method,
                body
            }).then(res => {
                return res.json()
            })
        }
    },
    computed: {
        $apiUrl() { return getApiUrl() },
    }
}

export default mixin
