import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import './index.css'
import './assets/line-awesome/css/line-awesome.min.css'
import store from './store'
import {abilitiesPlugin} from '@casl/vue'



createApp(App)
.use(abilitiesPlugin, store.getters.ability)
.use(store)
.use(router)
.mount('#app')
