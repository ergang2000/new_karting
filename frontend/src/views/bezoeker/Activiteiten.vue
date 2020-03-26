<template>
    <div>
        <div v-if="!activiteiten.length" class="d-flex justify-content-center mb-3">
            <b-spinner id="spinner"></b-spinner>
        </div>
        <div v-else>
            <b-table :items="activiteiten" :fields="fields" show-empty style="table-layout: fixed" caption-top>
                <template v-slot:table-caption>Dit zijn alle beschikbare activiteiten</template>
            </b-table>
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
            activiteiten: [],
            fields: [
                {
                    key: 'datum',
                    label: 'Datum',
                    formatter (value) {
                        return moment(value).format('DD-MM-YYYY')
                    }
                },
                {
                    key: 'tijd',
                    label: 'Tijd',
                    formatter(value) {
                        return moment(value).format('HH:mm')
                    }
                },
                { key: 'maxDeelnemers', label: 'Max deelnemers' },
                { key: 'soort.naam', label: 'Soort activiteit' },
                {
                    key: 'soort.prijs',
                    label: 'Prijs',
                    formatter(value) {
                        return '€' + formatMoney(value, 2, ',', '.')
                    }
                },
            ]
        }),
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