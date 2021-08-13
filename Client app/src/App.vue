<template>
  <v-app>
    <v-app-bar app class="light-blue darken-1">
      <v-toolbar-title>
        <router-link to="/chat/0" tag="span" style="cursor: pointer">Chat</router-link>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items v-for="item in menuItems" v-bind:key="item.route">
        <v-btn text :key="item.title" v-on:click="item.click ? item.click() : ()=> {}" :to="item.route">
          <v-icon left>{{ item.icon }}</v-icon>
          <div class="hidden-xs-only">{{ item.title }}</div>
        </v-btn>
      </v-toolbar-items>
    </v-app-bar>
    <v-content>
      <div class="pt-10">
          <router-view></router-view>
      </div>
    </v-content>
  </v-app>
</template>

<script>
  export default {
      methods: {
          logout() {
              if (! confirm('Are you sure?'))
                  return

              this.$store.commit('logout')
              this.$forceUpdate()
              this.$router.push('/login')
          }
      },
    computed: {
      menuItems () {
        let items = [
          { icon: 'mdi-face', title: 'Register', route: '/register' },
          { icon: 'mdi-lock-open', title: 'Login', route: '/login' }
        ]
        if (this.userIsAuthenticated) {
          items = [
            {icon: "mdi-logout", title: 'Logout!', click: this.logout}
          ]
        }
        return items
      },
      userIsAuthenticated () {
        return this.$store.getters.accessToken
      }
    }
  }
</script>