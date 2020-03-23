import Activiteit from '@/models/Activiteit'

interface User {
    id: number
    username: string
    email: string
    voorletters: string
    tussenvoegsel?: string | undefined | null
    adres: string
    postcode: string
    woonplaats: string
    telefoon: string
    roles: Array<string>
    activiteiten: Array<Activiteit>
}

export default User