<template>
    <b-nav-item :to="to" :active="isActive"><slot></slot></b-nav-item>
</template>

<script>
    export default {
        name: 'NavbarItem',
        props: {
            to: String
        },
        computed: {
            isActive() {
                console.log(this.$router.currentRoute.path)
                return this.$router.currentRoute.path === this.to
            }
        }
    }
</script>

<style scoped>

</style>