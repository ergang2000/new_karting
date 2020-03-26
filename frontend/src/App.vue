<template>
    <div>
        <b-container id="container">
            <Header />
            <Navbar />
            <Banner />
            <router-view/>
            <hr>
            <Footer />
        </b-container>
    </div>
</template>
<script>
    import Header from '@/components/Header'
    import Navbar from '@/components/nav/Navbar'
    import Banner from '@/components/Banner'
    import Footer from '@/components/Footer'
    import { isUndefinedOrNullOrEmpty } from 'bootstrap-vue/esm/utils/inspect';
    export default {
        components: { Footer, Banner, Navbar, Header },
        methods: {
            isUserRoute(route) {
                return route.search('/user') >= 0
            },
            redirectIfNeeded(route) {
                if (this.isUserRoute(route) && !this.isUserAuthenticated) {
                    this.$router.push('/login')
                } else if (this.isUserAuthenticated) {
                    this.$router.push('/user/activiteiten')
                }
            }
        },
        computed: {
            isUserAuthenticated() {
                return !isUndefinedOrNullOrEmpty(this.$store.state.token)
            },
        },
        created() {
            this.redirectIfNeeded(this.$router.currentRoute.path)
        },
        watch: {
            $router(to, from) {
                this.redirectIfNeeded(to.fullPath)
            }
        }
    }
</script>
<style scoped>
    #container {
        padding-top: 20px;
        background-color: white;
    }
</style>