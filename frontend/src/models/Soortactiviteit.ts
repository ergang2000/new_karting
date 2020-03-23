import Activiteit from '@/models/Activiteit'

interface Soortactiviteit {
    id: number
    naam: string
    minLeeftijd: number
    tijdsduur: number
    prijs: number
    beschrijving: string
    activiteiten: Array<Activiteit>
}

export default Soortactiviteit