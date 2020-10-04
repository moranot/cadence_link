<template>
  <v-footer app>
    <v-row>
      <v-col cols="4">
        <a :href="'/privacy'">Privacy Policy</a>
      </v-col>
      <v-col cols="4">
      </v-col>
      <v-col cols="4">
      </v-col>
    </v-row>
  </v-footer>
</template>

<script>
  export default {
    data: function () {
      return {
        url: process.env.APP_URL,
        items: [
          { icon: '',title: 'Route 1',route: '#' },
          { icon: '',title: 'Route 2',route: '#' },
          { icon: '',title: 'Route 3',route: '#' }
        ]
      }
    },
  }
</script>
