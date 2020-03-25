<template>
    <div>
        <div v-if="!activiteiten.length" class="d-flex justify-content-center mb-3">
            <b-spinner id="spinner"></b-spinner>
        </div>
        <div v-else>
            <b-row style="margin-left: 2px">
                <caption>
                    Dit zijn alle beschikbare activiteiten
                </caption>
            </b-row>
            <b-table :items="getConvertedActiviteiten" style="table-layout: fixed"/>
        </div>
    </div>
</template>

<script>
    import { getActiviteiten } from '../../services/Activiteit_service';
    import moment from 'moment'
    import { formatMoney } from '@/utils';

    export default {
        name: "Activiteiten",
        data: () => ({
            activiteiten: []
        }),
        computed: {
            getConvertedActiviteiten() {

                return this.activiteiten.map(activiteit => {
                    const tijd = moment(activiteit.tijd)
                    const datum = moment(activiteit.datum)

                    return {
                        datum: datum.format('DD-MM-YYYY'),
                        tijd: tijd.format('HH:mm'),
                        max_deelnemers: activiteit.maxDeelnemers,
                        soort_activiteit: activiteit.soort.naam,
                        prijs: '€' + formatMoney(activiteit.soort.prijs, 2, ',', '.')
                    }
                })
            }
        },
        created() {
            this.$call(getActiviteiten()).then(res => this.activiteiten = res)
        },
    }
</script>

<style scoped>
    #spinner {
        width: 4rem;
        height: 4rem;
    }
</style>