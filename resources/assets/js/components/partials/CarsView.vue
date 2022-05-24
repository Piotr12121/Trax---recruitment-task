<template>
    <div>
        <v-layout style="margin-bottom: 20px">
            <v-flex style="text-align: right" xs12>
                <v-btn class="success" @click="addCarSelected">Add Car</v-btn>
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
                        <tr @click="rowClicked(props.item.id)">
                            <td>{{ props.item.year }}</td>
                            <td>{{ props.item.make }}</td>
                            <td>{{ props.item.model }}</td>
                        </tr>
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
        console.log('Component CarsView mounted.');
        this.fetch();
    },
    created() {
        console.log('Component CarsView created.')
    },
    data() {
        return {
            items: [],
            headers: [
                {text: 'Year', value: 'date'},
                {text: 'Make', value: 'make'},
                {text: 'Model', value: 'model'},
            ]
        }
    },
    watch: {},
    computed: {},
    methods: {
        fetch() {
            axios.get(traxAPI.getCarsEndpoint())
                .then(response => {
                    this.items = response.data.data;
                }).catch(e => {
                console.log(e);
            });
        },
        rowClicked(id) {
            this.$router.push('/cars/' + id);
        },
        addCarSelected() {
            this.$router.push('/new-car');
        }
    },
    components: {}
}
</script>

<style lang="scss" scoped>

</style>
