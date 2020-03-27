<template>
    <b-navbar toggleable="lg" variant="light">
        <b-navbar-brand to="#">Kartcentrum</b-navbar-brand>
        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
        <UserNavbar v-if="isLoggedIn" />
        <BezoekerNavbar v-else />
    </b-navbar>
</template>

<script>
    import BezoekerNavbar from '@/components/nav/BezoekerNavbar';
    import UserNavbar from '@/components/nav/UserNavbar';
    import { isUndefinedOrNullOrEmpty } from 'bootstrap-vue/esm/utils/inspect';

    export default {
        name: 'Navbar',
        components: { UserNavbar, BezoekerNavbar },
        computed: {
            isLoggedIn() {
                return !isUndefinedOrNullOrEmpty(this.$store.state.token)
            }
        }
    }
</script>

<style scoped>
</style>