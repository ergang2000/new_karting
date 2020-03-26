<template>
    <LoginForm :loading="loading" @submitLogin="submit" />
</template>

<script>
    import LoginForm from '../components/forms/LoginForm';
    import { getUser, loginCall } from '../services/User_service';
    export default {
        name: 'Login',
        components: { LoginForm },
        data: () => ({
            loading: false
        }),
        methods: {
            onError() {
                this.$bvToast.toast('Verkeerde gebruikersnaam of wachtwoord', {
                    title: 'Inloggen mislukt',
                    variant: 'danger',
                    solid: true
                })
                this.loading = false
            },
            submit(username, password) {
                this.loading = true
                this.$call(loginCall(username, password))
                    .then(res => this.getUser(res.token))
                    .catch(() => this.onError())
            },
            getUser(token) {
                this.$call(getUser(token))
                    .then(res => {
                        this.$store.dispatch('login', { token, user: res })
                            .then(() => {
                                this.$root.$bvToast.toast('U heeft successvol ingelogd', {
                                    variant: 'success',
                                    title: 'Ingelogd',
                                    solid: true
                                })

                                this.loading = false

                                this.$router.push('/user/activiteiten')
                            })
                            .catch(() => this.onError())
                    })
                    .catch(() => this.onError())
            }
        }
    }
</script>

<style scoped>

</style>