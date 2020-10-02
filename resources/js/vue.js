import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';
import upperFirst from 'lodash/upperFirst';
import camelCase from 'lodash/camelCase';
import AppTemplate from './components/templates/AppTemplate';

Vue.use(Vuetify);

const requireBaseComponents = require.context(
    './components/bases',
    true,
    /Base[A-Z]\w+\.(vue|js)$/
);

requireBaseComponents.keys().forEach(fileName => {
    const componentConfig = requireComponent(fileName);
    const componentName = upperFirst(
        camelCase(
            fileName
                .split('/')
                .pop()
                .replace(/\.\w+$/, '')
        )
    );

    Vue.component(
        componentName,
        componentConfig.default || componentConfig
    );
});

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify({
        theme: {
            dark: true
        }
    }),
    components: {
        'app-template': AppTemplate,
    }
});