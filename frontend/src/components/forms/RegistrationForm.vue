<template>
    <b-form v-on:submit.prevent="submit">
        <b-form-group
            id="usernameGroup"
            label="Gebruikersnaam"
            label-for="username"
        >
            <b-form-input
                id="username"
                v-model="user.username"
                type="text"
                required
            />
        </b-form-group>
        <b-form-group
                id="passwordGroup"
                label="Wachtwoord"
                label-for="password"
        >
            <b-form-input
                    id="wachtwoord"
                    v-model="user.plainPassword"
                    type="password"
                    required
            />
        </b-form-group>
        <b-form-group
                :validated="confirmPassword"
                id="confirmGroup"
                label="Herhaal wachtwoord"
                label-for="confirm"
                invalid-feedback="Wachtwoorden komen niet overeen"
        >
            <b-form-input
                    id="confirm"
                    v-model="confirmPassword"
                    type="password"
                    required
            />
        </b-form-group>
        <b-form-group
                id="voorlettersGroup"
                label="Voorletters"
                label-for="voorletters"
        >
            <b-form-input
                    id="voorletters"
                    v-model="user.voorletters"
                    type="text"
                    required
            />
        </b-form-group>
        <b-form-group
                id="tussenvoegselGroup"
                label="Tussenvoegsel"
                label-for="tussenvoegsel"
        >
            <b-form-input
                    id="tussenvoegsel"
                    v-model="user.tussenvoegsel"
                    type="text"
            />
        </b-form-group>
        <b-form-group
                id="achternaamGroup"
                label="Achternaam"
                label-for="achternaam"
        >
            <b-form-input
                    id="achternaam"
                    v-model="user.achternaam"
                    type="text"
                    required
            />
        </b-form-group>
        <b-form-group
                id="adresGroup"
                label="Adres"
                label-for="adres"
        >
            <b-form-input
                    id="adres"
                    v-model="user.adres"
                    type="text"
                    required
            />
        </b-form-group>
        <b-form-group
                id="postcodeGroup"
                label="Postcode"
                label-for="postcode"
        >
            <b-form-input
                    id="postcode"
                    v-model="user.postcode"
                    type="text"
                    required
            />
        </b-form-group>
        <b-form-group
                id="woonplaatsGroup"
                label="Woonplaats"
                label-for="woonplaats"
        >
            <b-form-input
                    id="woonplaats"
                    v-model="user.woonplaats"
                    type="text"
                    required
            />
        </b-form-group>
        <b-form-group
                :validated="emailValidation"
                id="emailGroup"
                label="email"
                label-for="email"
                invalid-feedback="Dit is geen valide email"
        >
            <b-form-input
                    id="email"
                    v-model="user.email"
                    type="email"
                    required
            />
        </b-form-group>
        <b-form-group
                id="telefoonGroup"
                label="Telefoon"
                label-for="telefoon"
        >
            <b-form-input
                    id="telefoon"
                    v-model="user.telefoon"
                    type="text"
                    required
            />
        </b-form-group>
        <b-button type="submit" variant="primary">registreren</b-button>
    </b-form>
</template>

<script>
    import User from '../../models/User'

    export default {
        name: 'RegistrationForm',
        props: {
            user: User
        },
        data: () => ({
            confirmPassword: undefined,
        }),
        computed: {
            // nameValidation() { return this.user.username.length < 25 },
            confirmationValidation() { return this.user.plainPassword === this.confirmPassword },
            emailValidation() {
                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(this.user.email);
            },
        },
        methods: {
            submit() {
                this.$emit('submitRegistration')
            }
        }
    }
</script>

<style scoped>

</style>