<template>
    <ProfileForm :user="user" :loading="loading" @submitProfile="submit" />
</template>

<script>
    import ProfileForm from '../../components/forms/ProfileForm';
    import { updateProfile } from '../../services/User_service';
    export default {
        name: 'Profile',
        components: { ProfileForm },
        data: () => ({
            user: undefined,
            loading: false
        }),
        methods: {
            submit() {
                this.loading = true
                this.user = {
                    ...this.user,
                    id: undefined,
                    activiteiten: undefined,
                    roles: undefined
                }

                this.$call(updateProfile(this.user))
                    .then(res => {
                        this.$store.dispatch('newUser', res)
                            .then(() => {
                                this.$root.$bvToast.toast('Jouw profiel is succesvol geüpdate', {
                                    title: 'Profiel gewijzigd',
                                    variant: 'success',
                                    solid: true
                                })

                                this.$router.push('/user/activiteiten')
                            })

                        this.loading = false
                    })
                    .catch(() => {
                        this.$bvToast.toast('Er is iets fout gegaan', {
                            variant: 'danger',
                            solid: true
                        })

                        this.loading = false
                    })
            }
        },
        created() {
            this.user = this.$store.state.user
        }
    }
</script>

<style scoped>

</style>