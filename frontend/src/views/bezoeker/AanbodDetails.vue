<template>
    <div>
        <div v-if="soort === undefined" class="d-flex justify-content-center mb-3">
            <b-spinner id="spinner"></b-spinner>
        </div>
        <b-table-simple v-else bordered style="table-layout: fixed">
            <caption style="caption-side: top">Soort</caption>
            <tr>
                <td>Naam:</td>
                <td class="text-primary">{{ soort.naam }}</td>
            </tr>
            <tr>
                <td>Beschrijving:</td>
                <td>{{ beschrijving }} </td>
            </tr>
            <tr >
                <td>prijs:</td>
                <td>€ {{ formattedPrijs }}</td>
            </tr>
            <tr >
                <td>tijdsduur:</td>
                <td>{{ minuten }}</td>
            </tr>
            <tr>
                <td>Minimum leeftijd:</td>
                <td>{{ soort.minLeeftijd }} </td>
            </tr>
        </b-table-simple>
    </div>
</template>

<script>
    import { getSoort } from '../../services/Soortactiviteit_service';
    import { formatMoney } from '@/utils';
    import { isUndefinedOrNullOrEmpty } from 'bootstrap-vue/esm/utils/inspect';

    export default {
        name: 'AanbodDetails',
        data: () => ({
            soort: undefined
        }),
        computed: {
            formattedPrijs() {
                return formatMoney(this.soort.prijs, 2, ',', '.')
            },
            minuten() {
                return `${this.soort.tijdsduur} ${this.soort.tijdsduur === 1 ? 'minuut' : 'minuten'}`
            },
            beschrijving() {
                return isUndefinedOrNullOrEmpty(this.soort.beschrijving) ? 'Geen.' : this.soort.beschrijving
            }
        },
        created() {
            this.$call(getSoort(this.$router.currentRoute.params.id))
                .then(res => this.soort = res)
                .catch(() => this.$bvToast.toast('Something went wrong', { variant: 'danger' }))
        }
    }
</script>

<style scoped>
    #spinner {
        width: 4rem;
        height: 4rem;
    }
</style>