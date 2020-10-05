<template>
    <v-card>
        <v-card-title><strong>Delete</strong> User</v-card-title>
        <v-alert v-if="status" v-bind:type="status.type">
            {{ status.message }}
        </v-alert>
        <v-card-actions>
            <v-form ref="form" v-model="valid" @submit.prevent>
                <v-text-field v-model="email" :rules="emailRules" label="Email" required></v-text-field>
                <v-btn @click="submit">Submit</v-btn>
            </v-form>
        </v-card-actions>
    </v-card>
</template>

<script>
import axios from 'axios';

export default {
    data: function () {
        return {
            url: process.env.MIX_APP_URL,
            email: '',
            emailRules: [
                v => !!v || 'Emaiil is required',
                v=> /.+@.+/.test(v) || 'Email must be valid'
            ],
            status: {
                type: '',
                message: '',
            },
        }
    },
    methods: {
        submit () {
            let data = { email: this.email };
            axios.post(url+'/user/delete', data)
            .then( function (response) {
                this.status.type = 'success';
                this.status.message = response;
            })
            .catch( function (error) {
                this.status.type = 'error';
                this.atatus.message = error;
            });
        }
    }
}
</script>