// import './bootstrap';
import { createApp } from 'vue';
import store from "./store";
import router from "./router"
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import App from "./components/App.vue";


const app = createApp({});

app.component('App', App);

app.use(store)
app.use(router);
app.use(ElementPlus)

app.mount('#app');
