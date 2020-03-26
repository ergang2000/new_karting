<template>
    <b-nav-item :to="to" :active="isActive" @click="$emit('click')"><slot></slot></b-nav-item>
</template>

<script>
    export default {
        name: 'NavbarItem',
        props: {
            to: String
        },
        data: () => ({
            currentRoute: ''
        }),
        computed: {
            isActive() {
                return this.currentRoute === this.to
            }
        },
        watch: {
            $route(to, from) {
                this.currentRoute = to.fullPath
            }
        },
        created() {
            this.currentRoute = this.$router.currentRoute.path
        }
    }
</script>

<style scoped>

</style>