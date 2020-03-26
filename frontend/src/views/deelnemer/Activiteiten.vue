<template>
    <div>
        <b-table style="table-layout: fixed" :items="formattedBeschikbaar" :fields="beschikbaarFields" v-if="!beschikbaarLoading" caption-top show-empty>
            <template v-slot:table-caption>Dit zijn alle beschikbare activiteiten</template>
            <template v-slot:cell(actions)="row">
                <b-icon-plus v-if="row.item.openPlaatsen > 0" class="myIcon" @click="inschrijven(row.item)" />
            </template>
        </b-table>
        <div v-else class="d-flex justify-content-center mb-3">
            <b-spinner class="spinner" />
        </div>
        <b-table style="table-layout: fixed" :items="formattedIngeschreven" :fields="inschrijvenFields" v-if="!ingeschrevenLoading" caption-top show-empty>
            <template v-slot:table-caption>Dit zijn de door jou ingeschreven activiteiten</template>
            <template v-slot:cell(actions)="row">
                <b-icon-dash v-if="row.index !== (formattedIngeschreven.length - 1)" class="myIcon" @click="uitschrijven(row.item)"/>
            </template>
        </b-table>
        <div v-else class="d-flex justify-content-center mb-3">
            <b-spinner class="spinner" />
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import { formatMoney } from '@/utils';
    import {
        getBeschikbareActiviteiten,
        getIngeschrevenActiviteiten,
        inschrijven, uitschrijven,
    } from '@/services/Activiteit_service';

    export default {
        name: 'Activiteiten',
        data: () => ({
            beschikbaar: [],
            ingeschreven: [],
            beschikbaarLoading: true,
            ingeschrevenLoading: true,
            beschikbaarFields: [
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
                { key: 'openPlaatsen', label: 'Open plaatsen' },
                { key: 'soort.naam', label: 'Soort activiteit' },
                {
                    key: 'soort.prijs',
                    label: 'Prijs',
                    formatter(value) {
                        return '€' + formatMoney(value, 2, ',', '.')
                    }
                },
                { key: 'actions', label: 'Inschrijven' }
            ],
            inschrijvenFields: [
                {
                    key: 'datum',
                    label: 'Datum',
                    formatter (value) {
                        return value && moment(value).format('DD-MM-YYYY')
                    }
                },
                {
                    key: 'tijd',
                    label: 'Tijd',
                    formatter(value) {
                        return value && moment(value).format('HH:mm')
                    }
                },
                { key: 'soort.naam', label: 'Soort activiteit' },
                {
                    key: 'soort.prijs',
                    label: 'Prijs',
                    formatter(value) {
                        return '€' + formatMoney(value, 2, ',', '.')
                    }
                },
                { key: 'actions', label: 'Uitschrijven' }
            ]
        }),
        computed: {
            formattedBeschikbaar() {
                if (this.beschikbaar.length === 0) {
                    return []
                }

                return this.beschikbaar.map(activiteit => ({
                    ...activiteit,
                    openPlaatsen: activiteit.maxDeelnemers - activiteit.users.length,
                    _rowVariant: activiteit.maxDeelnemers - activiteit.users.length === 0 ? 'danger' : undefined
                })).sort((activiteit1, activiteit2) => moment(activiteit1.datum).toDate() - moment(activiteit2.datum).toDate())
            },
            formattedIngeschreven() {
                const formatted = this.ingeschreven
                let total = 0
                formatted.forEach(activiteit => total += activiteit.soort.prijs)
                formatted.sort((activiteit1, activiteit2) => moment(activiteit1.datum).toDate() - moment(activiteit2.datum).toDate())

                return [
                    ...formatted,
                    {
                        datum: undefined,
                        tijd: undefined,
                        soort: { naam: 'Totale prijs:', prijs: total },
                    }
                ]
            }
        },

        methods: {
            showError(message = 'Er is iets misgegaan') {
                this.$bvToast.toast(message, {
                    variant: 'danger',
                    solid: true,
                })
            },
            inschrijven(activiteit) {
                this.beschikbaar = this.beschikbaar.filter(act => act.id !== activiteit.id)
                this.ingeschreven.push(activiteit)

                this.$call(inschrijven(activiteit.id))
                    .then(res => {
                        if (!res.success) {
                            this.showError(res.error)
                            this.ingeschreven = this.ingeschreven.filter(act => act.id !== activiteit.id)
                            this.beschikbaar.push(activiteit)
                        }
                    })
                    .catch(() => {
                        this.showError()
                        this.ingeschreven = this.ingeschreven.filter(act => act.id !== activiteit.id)
                        this.beschikbaar.push(activiteit)
                    })
            },
            uitschrijven(activiteit) {
                this.ingeschreven = this.ingeschreven.filter(act => act.id !== activiteit.id)
                this.beschikbaar.push(activiteit)

                this.$call(uitschrijven(activiteit.id))
                    .catch(() => {
                        this.showError()
                        this.beschikbaar = this.beschikbaar.filter(act => act.id !== activiteit.id)
                        this.ingeschreven.push(activiteit)
                    })
            }
        },

        created() {
            this.$call(getBeschikbareActiviteiten()).then(res => {
                this.beschikbaar = res
                this.beschikbaarLoading = false
            })
            this.$call(getIngeschrevenActiviteiten()).then(res => {
                this.ingeschreven = res
                this.ingeschrevenLoading = false
            })
        }
    }
</script>

<style scoped>
    .spinner {
        width: 4rem;
        height: 4rem;
    }

    .myIcon {
        font-size: 30px;
        color: red;
    }

    .myIcon:hover {
        cursor: pointer;
    }
</style>