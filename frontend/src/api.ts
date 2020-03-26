import { getApiUrl } from '@/constants'
import { Vue } from 'vue-property-decorator'
import { ComponentOptions } from 'vue'
import { $internalHooks } from 'vue-class-component/lib/component'

declare type method = 'POST' | 'GET' | 'PUT' | 'DELETE'

export interface ApiObject {
    url: string
    method: method
    parameters?: Record<string, any>
    headers?: Record<string, any>
}

const apiUrl = getApiUrl()

const mixin: ComponentOptions<Vue> = {
    methods: {
        $call(api: ApiObject) {
            // const body: FormData = new FormData()
            let body = '{}'
            let headers: Record<string, any> = {
                ['Content-Type']: 'application/json',
                Authorization: undefined
            }

            if (api.parameters) {
                body = JSON.stringify(api.parameters)
            }

            if (this.$store.state.token && this.$store.state.token.length > 0) {
                headers.Authorization = `Bearer ${this.$store.state.token}`
            }

            if (api.headers) {
                headers = {
                    ...headers,
                    ...api.headers
                }
            }

            if (api.method === 'GET') {
                return fetch(apiUrl + api.url, {
                    method: api.method.toLowerCase(),
                    headers,
                }).then(res => {
                    return res.json()
                })
            }

            return fetch(apiUrl + api.url, {
                method: api.method,
                headers,
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
