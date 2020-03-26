<template>
    <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
            <NavbarItem to="/user/activiteiten">home</NavbarItem>
            <NavbarItem to="#">profiel</NavbarItem>
            <NavbarItem to="#">wachtwoord</NavbarItem>
        </b-navbar-nav>
        <b-navbar-nav class="ml-auto">
            <NavbarItem @click="logout">{{ $store.state.user.username }} uitloggen</NavbarItem>
        </b-navbar-nav>
    </b-collapse>
</template>

<script>
    import NavbarItem from './NavbarItem';
    export default {
        name: 'UserNavbar',
        components: { NavbarItem },
        methods: {
            logout() {
                this.$store.dispatch('logout')
                    .then(() => this.$router.push('/'))
            }
        }
    }
</script>

<style scoped>

</style>