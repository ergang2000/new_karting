<template>
    <b-nav pills>
        <NavbarItem to="/">home</NavbarItem>
        <NavbarItem to="#">contact</NavbarItem>
        <NavbarItem to="#" id="login">inloggen</NavbarItem>
    </b-nav>
</template>

<script>
    import NavbarItem from '@/components/NavbarItem'

    export default {
        name: 'Navbar',
        components: { NavbarItem }
    }
</script>

<style scoped>
    #login {
        margin-left: auto;
    }
</style>