<template>
    <b-form @submit.prevent="$emit('submitLogin', username, password)">
        <b-form-group
            id="usernameGroup"
            label="Gebruikersnaam"
            label-for="username"
        >
            <b-form-input
                id="username"
                type="text"
                v-model="username"
                required
            />
        </b-form-group>
        <b-form-group
                id="passwordGroup"
                label="Wachtwoord"
                label-for="password"
        >
            <b-form-input
                    id="password"
                    type="password"
                    v-model="password"
                    required
            />
        </b-form-group>
        <b-form-row>
            <b-button type="submit" variant="primary" :disabled="disabled">Login</b-button>
            <b-spinner v-if="loading" />
        </b-form-row>
    </b-form>
</template>

<script>
    export default {
        name: 'LoginForm',
        props: {
            loading: Boolean
        },
        data: () => ({
            username: '',
            password: ''
        }),
        computed: {
            disabled() {
                return this.loading || this.username.length === 0 || this.password.length === 0
            }
        }
    }
</script>

<style scoped>

</style>