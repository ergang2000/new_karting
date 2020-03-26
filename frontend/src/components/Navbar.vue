<template>
    <b-navbar toggleable="lg" variant="light">
        <b-navbar-brand to="/">Kartcentrum</b-navbar-brand>
        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
        <b-collapse id="nav-collapse" is-nav>
            <b-navbar-nav>
                <NavbarItem to="/">home</NavbarItem>
                <NavbarItem to="/kartactiviteiten">aanbod</NavbarItem>
                <NavbarItem to="/activiteiten">activiteiten</NavbarItem>
                <NavbarItem to="/registreren">registreren</NavbarItem>
                <NavbarItem to="#">contact</NavbarItem>
            </b-navbar-nav>
            <b-navbar-nav class="ml-auto">
                <NavbarItem to="/login">inloggen</NavbarItem>
            </b-navbar-nav>
        </b-collapse>
    </b-navbar>
</template>

<script>
    import NavbarItem from '@/components/NavbarItem'

    export default {
        name: 'Navbar',
        components: { NavbarItem }
    }
</script>

<style scoped>
</style>