<template>
    <div>
        <b-row>
            <b-col sm="4">
                <Panel header="SODI SR4 Simply Stunning" img="sodiLR4.png" />
            </b-col>
            <b-col sm="4">
                <Panel header="SODI SR5 Comfort and Style" img="sodiLR5.png" />
            </b-col>
            <b-col sm="4">
                <Panel header="SODI 2DRIVE Dream Racer" img="sodi2Drive.png" />
            </b-col>
        </b-row>
        <h4>Een schitterende sport </h4>

        Wil je met één of twee personen karten of ben je met een groep onder de 10 personen?
        Rij dan een Vrije Training. Een Vrije Training is een kart-heat (rit) van 15 minuten.
        Een Grand Prix of een Endurance race is leuk voor de echte kartfanaten, deze duren 60 min.
        Ervaar het ultieme racegevoel in een Kinder kart! Voor het karten krijgen kinderen (minimaal 8 jaar)
        eerst een briefing met een uitleg over de vlaggen en de werking van de kart.

        De karts hebben een 200 cc benzinemotor, zijn splinternieuw en voorzien van alle veiligheidsmaatregelen,
        zoals een rolbeugel en een 4-puntsgordel. Op de kartbaan rijden maximaal 14 karts.
        Let op, voor het karten zijn dichte schoenen verplicht. Tip: Karten met een korte broek is niet toegestaan.
        Wij hebben overalls ter beschikking, maar probeer indien mogelijk een lange broek aan te doen of mee te nemen.
    </div>
</template>

<script>
    import Panel from '@/components/Panel';
    import { call } from '@/api';
    import { getSoort } from '@/services/Soortactiviteit_service';
    import Soortactiviteit from '@/models/Soortactiviteit';
    export default {
        name: 'Home',
        components: {
            Panel,
        },
        data: () => ({
            soorten: undefined
        })
    }
</script>
