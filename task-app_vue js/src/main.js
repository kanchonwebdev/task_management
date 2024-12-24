import { createApp } from 'vue'
import App from './App.vue'
import SidebarCom from './components/SidebarCom.vue'
import HeaderCom from './components/HeaderCom.vue'
import router from './router'

const app = createApp(App)
app.component('SidebarCom', SidebarCom)
app.component('HeaderCom', HeaderCom)
app.use(router)
app.mount('#app');
