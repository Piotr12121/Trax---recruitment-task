<template>
    <div>
        <v-layout style="margin-bottom: 20px">
            <v-flex style="text-align: right" xs12>
                <v-btn class="success" @click="addTripSelected">Add Trip</v-btn>
            </v-flex>
        </v-layout>
        <v-layout>
            <v-flex xs12>
                <v-data-table
                    :disable-initial-sort="true"
                    :headers="headers"
                    :items="items"
                    class="elevation-1"
                    hide-actions
                >
                    <template slot="items" slot-scope="props">
                        <td>{{ props.item.date }}</td>
                        <td>{{ props.item.car.year + ' ' + props.item.car.make + ' ' + props.item.car.model }}</td>
                        <td>{{ props.item.miles }}</td>
                        <td>{{ props.item.total }}</td>
                    </template>
                </v-data-table>
            </v-flex>
        </v-layout>
    </div>
</template>

<script>

import {traxAPI} from "../../traxAPI";

export default {
    props: [],
    mounted() {
        console.log('Component TripsView mounted.');
        this.fetch();
    },
    created() {
        console.log('Component TripsView created.')
    },
    data() {
        return {
            items: [],
            headers: [
                {text: 'Date', value: 'date'},
                {text: 'Car', value: 'car'},
                {text: 'Miles', value: 'miles'},
                {text: 'Miles Balance', value: 'total'},
            ]
        }
    },
    watch: {},
    computed: {},
    methods: {
        fetch() {
            axios.get(traxAPI.getTripsEndpoint())
                .then(response => {
                    this.items = response.data.data;
                }).catch(e => {
                console.log(e);
            });
        },
        addTripSelected() {
            this.$router.push('new-trip')
        }
    },
    components: {}
}
</script>

<style lang="scss" scoped>

</style>
