import Vue from 'vue'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import dotenv from 'dotenv'
const config  = dotenv.config()

import router from './router'
import { store } from './store'
import AlertComponent from './components/Shared/Alert.vue'
import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');


Vue.config.productionTip = false
Vue.component('app-alert', AlertComponent)

new Vue({
  vuetify,
  router,
  store,
  render: h => h(App),
  created () {
      window.Echo = new Echo({
          broadcaster: 'pusher',
          key: process.env.VUE_APP_MIX_PUSHER_APP_KEY,
          cluster: process.env.VUE_APP_MIX_PUSHER_APP_CLUSTER,
          encrypted: true,
          authEndpoint: process.env.VUE_APP_AUTH_URL,
          auth: {
              headers: {
                  Authorization: 'Bearer ' + localStorage.getItem('access_token')
              },
          },
      });
  }
}).$mount('#app')
