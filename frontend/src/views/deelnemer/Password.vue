<template>
    <PasswordForm :loading="loading" @submitPassword="submit" />
</template>

<script>
    import PasswordForm from '../../components/forms/PasswordForm';
    import { updatePassword } from '../../services/User_service';
    export default {
        name: 'Password',
        components: { PasswordForm },
        data: () => ({
            loading: false
        }),
        methods: {
            onError() {
                this.$bvToast.toast('Er is iets misgegaan', {
                    variant: 'danger',
                    solid: true
                })
            },
            submit(password) {
                this.loading = true
                this.$call(updatePassword(password))
                    .then(res => {
                        if (!res.success) {
                            this.onError()
                        } else {
                            this.$root.$bvToast.toast('Jouw wachtwoord is gewijzigd', {
                                variant: 'success',
                                solid: true,
                                title: 'Wachtwoord gewijzid!'
                            })
                            this.$router.push('/user/activiteiten')
                        }
                        this.loading = false
                    })
                    .catch(() => {
                        this.onError()
                        this.loading = false
                    })
            }
        }
    }
</script>

<style scoped>

</style>