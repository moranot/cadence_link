<template>
    <v-data-table
        :headers="headers"
        :items="models"
        :items-per-page="10"
    >
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>{{ modelLabel }}s</v-toolbar-title>
                <v-divider inset vertical></v-divider>
                <v-spacer></v-spacer>
            </v-toolbar>
            <v-dialog v-model="dialog">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn v-bind="attrs" v-on="on">
                        {{currentModeLabel + ' ' + modelLabel }}
                    </v-btn>
                </template>
                <v-card>
                    <v-card-title>
                        <span>{{ currentModeLabel + modelLabel }}</span>
                    </v-card-title>
                    <v-card-text>
                        <v-text-field 
                            v-for="header in headers"
                            :key="header.id"
                            v-model="currentModel[header]"
                            :label="modelLabel"
                            :disabled="currentMode == 'delete'"
                        >
                        </v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn text @click="closeDialog">Cancel</v-btn>
                        <v-btn text @click="submitModel">Submit</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-dialog>
            <v-alert v-if="statusMsg">
                {{ statusMsg }}
            </v-alert>
        </template>
        <template v-slot:[`currentModel.actions`]="{ currentModel }">
            <v-icon @click="selectMode('update', currentModel)">
                mdi-pencil
            </v-icon>
            <v-icon @click="selectMode('delete', currentModel)">
                mdi-delete
            </v-icon>
        </template>
        <template v-slot:no-data>
            <v-card>
                <v-card-title>
                    <span>No Data</span>
                </v-card-title>
                <v-card-text>
                    <span>No data was found for your request.</span>
                </v-card-text>
            </v-card>
        </template>
    </v-data-table>
</template>

<script>
import axios from 'axios';
var _ = require('lodash');

export default {
    props: ['csrf', 'model'],
    data: function () {
        return {
            url: process.env.MIX_APP_URL,
            dialog: false,
            statusMsg: '',
            headers: {},
            models: {},
            modelLabel: _.capitalize(this.model),
            defaultModel: {},
            currentModel: {},
            currentMode: 'new',
            currentModeLabel: 'New'
        }
    },
    created: function () {
        this.initialze();
    },
    methods: {
        initialize: function () {
            axios.post(url + '/' + model + '/index')
            .then( function (response) {
                this.headers = response.headers;
                this.models = response.models;
                this.statusMsg = response.statusMsg;
            })
            .catch( function (error) {
                this.statusMsg = error.statusMsg;
            });
            this.currentModel = this.defaultModel = this.default(headers);
        },
        default: function (elements) {
            elements.forEach( function (element) {
                switch (typeof element) {
                    case 'boolean':
                        this.defaultModel[element] = false
                    case 'number':
                        this.defaultModel[element] = 0
                    case 'bigint':
                        this.defaultModel[element] = 0
                    case 'string':
                        this.defaultModel[element] = ''
                    default:
                        this.defaultModel[element] = ''
                }
            })
        },
        selectMode: function (selectedMode, selectedModel) {
            this.currentMode = selectedMode;
            this.currentModeLabel = _.capitalize(this.currentMode);
            this.currentModel = selectedModel;
            this.dialog = true;
        },
        submitModel: function () {
            let data = { 
                id: this.currentModel.id
            };
            axios.post(url + '/' + this.model + '/' + this.currentMode, data)
            .then( function (response) {
                this.users = response.users;
                this.statusMsg = response.statusMsg;
            })
            .catch( function (error) {
                this.statusMsg = error.statusMsg;
            });
            this.dialog = false;
        },
        closeDialog: () => { 
            this.currentMode = 'new';
            this.currentModeLabel = 'New';
            this.dialog = false;
        },
    }
}
</script>