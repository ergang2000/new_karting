<template>
    <footer>
        <div style="float: right">
            <img class="img-thumbnail pull-right" src="../assets/linkedin.jpg">
            <img class="img-thumbnail pull-right" src="../assets/tweet.jpg">
            <img class="img-thumbnail pull-right" src="../assets/pinterest.png">
        </div>

        <p class="text-muted text-center">&copy;afdeling applicatieontwikkelaar Tinwerf 10, 2544 ED Den Haag. Telefoon:088 666 3600 </p>
    </footer>
</template>

<script>
    export default {
        name: 'Footer',
    }
</script>

<style scoped>
    img {
        width: 40px;
        margin-top: -10px;
        margin-bottom: 10px;
    }

    footer {
        overflow: auto;
    }
</style>