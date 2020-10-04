<template>
  <v-card>
    <v-system-bar></v-system-bar>
    <v-app-bar color="#033F63" app>
      <v-toolbar src="">
        <v-app-bar-nav-icon color="#02C39A" @click="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title>MixLink</v-toolbar-title>
      </v-toolbar>
    </v-app-bar>
    <v-navigation-drawer v-model="drawer" app>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title>MixLink</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <v-list dense nav>
        <v-list-item v-for="item in items" :key="item.title" link>
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>
          <v-list-item-content v-if="item.title">
            <a :href="item.route"><v-list-item-title>{{ item.title }}</v-list-item-title></a>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </v-card>
</template>

<script>
  export default {
    data: function () {
      return { 
        url: process.env.APP_URL,
        drawer: null,
        items: [
          { icon: '', title: 'Route 1', route: '#'},
          { icon: '', title: 'Route 2', route: '#'},
          { icon: '', title: 'Route 3', route: '#'}
        ]
      }
    }
  }
</script>