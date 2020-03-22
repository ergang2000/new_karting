<template>
    <b-card :header="header" :img-src="require(`../assets/${img}`)" img-alt="Kart foto" img-bottom />
</template>

<script>
    export default {
        name: 'Panel',
        props: {
            header: String,
            img: String,
        }
    }
</script>

<style scoped>
    img {
        width: 70%;
        margin-left: auto;
        margin-right: auto;
    }

    .card-header {
        color: white;
        background-color: #337ab7;
        border-color: #337ab7;
    }

    .card-body {
        height: 0px;
    }
</style>