<template>
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
</template>

<script>
    import NavbarItem from './NavbarItem';
    export default {
        name: 'BezoekerNavbar',
        components: { NavbarItem },
    }
</script>

<style scoped>

</style>