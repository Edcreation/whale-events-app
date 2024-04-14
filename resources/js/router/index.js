import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../components/pages/home/index.vue';
import SingleEvent from '../components/pages/singleEvent/index.vue';
import Events from '../components/pages/events/index.vue';
import ProfilePage from '../components/pages/profile/index.vue';

const routes = [
    { path: '/', component: HomeView },
    { path: '/events', component: Events },
    { path: '/profile', component: ProfilePage },
    { 
        path: '/event/:slug', 
        component: SingleEvent,
        props: true // Enable passing route params as props
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;