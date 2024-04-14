import { createApp } from 'vue';
import router from './router';
import App from './components/main.vue';
   
import store from './store';

import "@fortawesome/fontawesome-free/css/all.min.css";

createApp(App)
    .use(store)
    .use(router) // Register the router
    .mount('#eddy');

