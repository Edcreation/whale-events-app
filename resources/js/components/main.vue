<template>
    <div id="eddy">
        <tavbar />
        <div
            class="min-h-screen flex flex-col items-center  top-0 w-full text-white bg-blueGray-800 bg-no-repeat bg-full">
            <router-view></router-view>
        </div>
        <Base />
    </div>
</template>

<script>
import tavbar from './navbar/index.vue';
import registerBg2 from "../assets/images/register_bg_2.png";
import Base from './footer/Footer.vue';
import 'vue3-toastify/dist/index.css';
import { mapActions } from 'vuex';

export default {
    name: 'Whale',
    data() {
        return {
            registerBg2,
        };
    },
    methods: {
        ...mapActions('auth', ['checkAuth']), // Map checkAuth action
    },
    components: {
        tavbar,
        Base
    },
    created() {
        this.checkAuth();
    },
};
</script>