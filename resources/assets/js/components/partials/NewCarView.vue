<template>
    <v-form ref="form" v-model="valid" lazy-validation>
        <v-text-field
            v-model="year"
            :rules="[v => !!v  || 'Item is required', v => (v && v.length === 4 && !isNaN(v)) || 'Must be 4 digit year']"
            label="Year"
            required
        ></v-text-field>
        <v-text-field
            v-model="make"
            :rules="[v => !!v || 'Item is required']"
            label="Make"
            required
        ></v-text-field>
        <v-text-field
            v-model="model"
            :rules="[v => (!!v) || 'Item is required']"
            label="Model"
            required
        ></v-text-field>

        <v-btn
            :disabled="!valid"
            @click="submit"
        >
            submit
        </v-btn>
        <v-btn @click="clear">clear</v-btn>

    </v-form>
</template>

<script>
import {traxAPI} from "../../traxAPI";

export default {
    props: [],
    mounted() {
        console.log('Component NewCarView mounted.')
    },
    created() {
        console.log('Component NewCarView created.')
    },
    data() {
        return {
            valid: true,
            year: null,
            make: null,
            model: null
        }
    },
    watch: {},
    computed: {},
    methods: {
        submit() {
            if (this.$refs.form.validate()) {
                axios.post(traxAPI.addCarEndpoint(), {
                    year: this.year,
                    make: this.make,
                    model: this.model
                }).then(response => {
                    this.$router.push('/cars')
                }).catch(e => {
                    console.log(e);
                });
            }
        },
        clear() {
            this.$refs.form.reset()
        }

    },
    components: {}
}
</script>

<style lang="scss" scoped>

</style>
