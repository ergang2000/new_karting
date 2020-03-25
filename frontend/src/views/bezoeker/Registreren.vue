<template>
    <div>
        <h3>Registreren</h3>

        <RegistrationForm :user="user" :loading="loading" @submitRegistration="submit" />
    </div>
</template>

<script>
    import RegistrationForm from '../../components/forms/RegistrationForm';
    import { registerUser } from '@/services/User_service';
    import { isUndefinedOrNullOrEmpty } from 'bootstrap-vue/esm/utils/inspect';
    export default {
        name: 'Registreren',
        components: { RegistrationForm },
        data: () => ({
            user: undefined,
            loading: false
        }),
        methods: {
            showError(err) {
                if (err.errors) {
                    err.errors.forEach(error => {
                        this.$bvToast.toast(error, {
                            variant: 'danger',
                            solid: true,
                            appendToast: true
                        })
                    })
                } else {
                    this.$bvToast.toast('Registratie gefaald!', {
                        variant: 'danger',
                        solid: true
                    })
                }
            },
            submit() {
                this.loading = true
                this.$call(registerUser(this.user))
                    .then(res => {
                        this.loading = false
                        if (res.success) {
                            let name
                            if (isUndefinedOrNullOrEmpty(this.user.tussenvoegsel)) {
                                name = `${this.user.voorletters} ${this.user.achternaam}`
                            } else {
                                name = `${this.user.voorletters} ${this.user.tussenvoegsel} ${this.user.achternaam}`
                            }

                            this.$root.$bvToast.toast(
                                name + ' is geregistreerd!',
                                {
                                    title: 'Registratie succesvol',
                                    variant: 'primary',
                                    solid: true
                                }
                            )

                            this.$router.push('/')
                        } else {
                            this.showError(res)
                        }
                    })
                    .catch(err => {
                        this.showError(err)
                        this.loading = false
                    })
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
                achternaam: '',
                woonplaats: '',
            }
        }
    }
</script>

<style scoped>

</style>