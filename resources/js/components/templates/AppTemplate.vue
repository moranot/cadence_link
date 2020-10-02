<template>
  <v-app>
    <v-navigation-drawer v-model="drawer" app>
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title>MixLink</v-list-item-title>
          <v-list-item-subtitle>Mix &amp; match songs from your favorite services</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>
      <v-divider></v-divider>
      <v-list dense nav>
        <v-list-item v-for="item in items" :key="item.title" link>
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>
          <v-list-item-content v-if="item.title">
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar color="#033F63" app>
      <v-toolbar src="">
        <v-app-bar-nav-icon color="#02C39A" @click="drawer = !drawer"></v-app-bar-nav-icon>

        <v-toolbar-title>MixLink</v-toolbar-title>
      </v-toolbar>
    </v-app-bar>

    <v-main>
        
    </v-main>
  </v-app>
</template>

<script>
  export default {
    data: () => (
      { 
        drawer: null 
      }
    ),
  }
</script>
