<template>
    <div>
        <h3>Wachtwoord wijzigen</h3>
        <b-form @submit.prevent="$emit('submitPassword', password)">
            <b-form-group
                    id="passwordGroup"
                    label="Wachtwoord"
                    label-for="password"
            >
                <b-form-input
                        id="wachtwoord"
                        v-model="password"
                        type="password"
                        required
                />
            </b-form-group>
            <b-form-group
                    :validated="confirmationValidation"
                    id="confirmGroup"
                    label="Herhaal wachtwoord"
                    label-for="confirm"
                    invalid-feedback="Wachtwoorden komen niet overeen"
            >
                <b-form-input
                        id="confirm"
                        v-model="confirmation"
                        type="password"
                        required
                />
            </b-form-group>
            <b-form-row>
                <b-button type="submit" variant="primary" :disabled="loading || !password.length || !confirmationValidation">
                    wijzig
                </b-button>
                <b-spinner v-if="loading" variant="primary" />
            </b-form-row>
        </b-form>
    </div>
</template>

<script>
    export default {
        name: 'PasswordForm',
        props: {
            loading: Boolean
        },
        data: () => ({
            password: '',
            confirmation: ''
        }),
        computed: {
            confirmationValidation() { return this.password === this.confirmation },
        }
    }
</script>

<style scoped>

</style>