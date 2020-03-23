<template>
    <section>
        <article>
            <div v-if="!activiteiten.length" class="d-flex justify-content-center mb-3">
                <b-spinner variant="primary" id="spinner"></b-spinner>
            </div>
            <div v-else>
                <h3>Er zijn {{ activiteiten.length }} soorten activiteiten </h3>
                <b-list-group>
                    <router-link v-for="activiteit in activiteiten" :key="activiteit.id" to="#">
                        <b-list-group-item class="text-primary">{{ activiteit.naam }}</b-list-group-item>
                    </router-link>
                </b-list-group>
                <p>
                    Let op, voor het karten zijn dichte schoenen verplicht.
                    Karten met een korte broek is niet toegestaan. Wij hebben overalls ter beschikking,
                    maar probeer indien mogelijk een lange broek aan te doen of mee te nemen.
                </p>
            </div>
        </article>
        <figure>
            <img src="../../assets/kart.jpg" class="img-responsive center-block" alt="kart">
        </figure>
    </section>
</template>

<script>
    import { call } from '../../api';
    import { getSoorten } from '../../services/Soortactiviteit_service';
    import Soortactiviteit from '../../models/Soortactiviteit';

    export default {
        name: "Aanbod",
        data: () => ({
            activiteiten: []
        }),
        created() {
            call(getSoorten()).then(res => this.activiteiten = res)
        }
    }
</script>

<style scoped>
    img {
        width: 30%;
    }
    figure {
        text-align: center;
    }
    #spinner {
        width: 4rem;
        height: 4rem;
    }
</style>