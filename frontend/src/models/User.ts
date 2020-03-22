class User {
    id: number = undefined
    username: string = undefined
    email: string = undefined
    voorletters: string = undefined
    tussenvoegsel?: string = undefined
    adres: string = undefined
    postcode: string = undefined
    woonplaats: string = undefined
    telefoon: string = undefined
    roles: Array<string> = undefined
}

export default User