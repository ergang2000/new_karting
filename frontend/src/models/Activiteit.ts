import User from '@/models/User'
import Soortactiviteit from '@/models/Soortactiviteit'

interface Activiteit {
    id: number
    datum: Date
    tijd: Date
    maxDeelnemers: number
    users: Array<User>
    soort: Soortactiviteit
}

export default Activiteit