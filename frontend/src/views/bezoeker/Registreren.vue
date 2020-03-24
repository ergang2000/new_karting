<template>
    <div>
        <h3>Registreren</h3>

        <RegistrationForm :user="user" @submitRegistration="submit" />
    </div>
</template>

<script>
    import RegistrationForm from '../../components/forms/RegistrationForm';
    import { call } from '@/api';
    import { registerUser } from '@/services/User_service';
    export default {
        name: 'Registreren',
        components: { RegistrationForm },
        data: () => ({
            user: undefined
        }),
        methods: {
            submit() {
                call(registerUser(this.user))
                    .then(_ => console.log('success'))
                    .catch(_ => console.log('failed'))
            }
        },
        created() {
            this.user = {
                username: '',
                plainPassword: '',
                email: '',
                adres: '',
                id: undefined,
                postcode: '',
                activiteiten: undefined,
                roles: undefined,
                telefoon: '',
                tussenvoegsel: undefined,
                voorletters: '',
                woonplaats: '',
            }
        }
    }
</script>

<style scoped>

</style>