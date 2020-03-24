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
    import Navbar from '@/components/Navbar'
    import Banner from '@/components/Banner'
    import Footer from '@/components/Footer'
    export default {
        components: { Footer, Banner, Navbar, Header },
    }
</script>
<style scoped>
    #container {
        padding-top: 20px;
        background-color: white;
    }
</style>