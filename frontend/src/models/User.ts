import Activiteit from '@/models/Activiteit'

interface User {
    id: number
    username: string
    email: string
    plainPassword?: string | undefined
    voorletters: string
    tussenvoegsel?: string | undefined | null
    achternaam: string
    adres: string
    postcode: string
    woonplaats: string
    telefoon: string
    roles: Array<string>
    activiteiten: Array<Activiteit>
}

export default User