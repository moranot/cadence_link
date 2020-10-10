<template>
    <v-card>
        <v-card-title>Users</v-card-title>
        <v-alert v-if="status" v-bind:type="status.type">
            {{ status.message }}
        </v-alert>
        <v-data-table
            :headers="headers"
            :items="users"
            :items-per-page="10"
        >
            <v-dialog v-model="dialog">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn v-bind="attrs" v-on="on">New User</v-btn>
                </template>
                <v-card>
                    <v-card-title>
                        <span class="headline">Edit User</span>
                    </v-card-title>
                    <v-card-text>
                        <v-text-field 
                            v-for="header in headers"
                            :key="header.id"
                            v-model="editedUser[header]"
                            label="{{ header[0].toUpperCase() + string.substring(1) }}">
                        </v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn text @click="cancelEdit">Cancel</v-btn>
                        <v-btn text @click="submit('update')">Save</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-dialog v-model="dialogDelete">
                <v-card>
                    <v-form ref="form" @submit.prevent>
                        <input type="hidden" name="_token" :value="csrf">
                        <v-card-title>Are you sure you want to delete this user?</v-card-title>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn text @click="cancelDelete">Cancel</v-btn>
                            <v-btn @click="submit('delete')">OK</v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-dialog>
        </v-data-table>
    </v-card>
</template>

<script>
import axios from 'axios';

export default {
    props: ['csrf'],
    data: function () {
        return {
            dialog: false,
            dialogDelete: false,
            url: process.env.MIX_APP_URL,
            status: {
                process: '',
                type: '',
                message: '',
            },
            headers: {},
            users: {},
            editedIndex: -1,
            editedUser: {
                
            },
            defaultUser: {

            },
        }
    },
    watch: {
        dialog (val) {
            val || this.close()
        },
        dialogDelete (val) {
            val || this.closeDelete()
        }
    },
    created: function () {
        this.initialze();
    },
    methods: {
        initialize: function () {
            axios.post(url+'/user/index', data)
            .then( function (response) {
                this.statusMsg = response.statusMsg;
                this.headers = response.headers;
                this.users = response.users;
            })
            .catch( function (error) {
                this.statusMsg = response.statusMsg;
            });
        },
        submit (method) {
            let data = { email: this.email };
            axios.post(url+'/user/'+method, data)
            .then( function (response) {
                this.statusMsg = response.statusMsg;
                this.users = response.users;
            })
            .catch( function (error) {
                this.status = response.statusMsg;
            });
        }
    }
}
</script>