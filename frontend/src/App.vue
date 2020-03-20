<template>
    <b-container id="container">
        <Header />
        <Navbar />
        <router-view/>
    </b-container>
</template>
<script>
    import Header from '@/components/Header';
    import Navbar from '@/components/Navbar';
    export default {
        components: { Navbar, Header },
    }
</script>
<style scoped>
    #container {
        padding-top: 20px;
        background-color: white;
    }
</style>