<template>
    <b-form v-on:submit.prevent="$emit('submitProfile')">
        <b-form-group
            id="usernameGroup"
            label="Gebruikersnaam"
            label-for="username"
        >
            <b-form-input
                id="username"
                v-model="user.username"
                type="text"
                disabled
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
        <b-form-row>
            <b-button type="submit" variant="primary" :disabled="loading">wijzig</b-button>
            <b-spinner v-if="loading" variant="primary" />
        </b-form-row>
    </b-form>
</template>

<script>
    import User from '../../models/User';

    export default {
        name: 'ProfileForm',
        props: {
            user: User,
            loading: Boolean,
        },
        computed: {
            emailValidation() {
                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(this.user.email);
            },
        },
    }
</script>

<style scoped>

</style>