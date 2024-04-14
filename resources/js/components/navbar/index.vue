<template>
    <nav
        class="top-0 z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg bg-blueGray-800 shadow">
        <div class="w-full px-2 mx-auto flex flex-wrap items-center justify-between">
            <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
                <router-link to="/">
                    <p
                        class="text-white text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase">
                        WHALE
                    </p>
                </router-link>
                <button
                    class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
                    type="button" v-on:click="setNavbarOpen">
                    <i :class="[navbarOpen ? 'fa-solid fa-x text-gray-100' : 'fas fa-bars text-gray-100']"></i>
                </button>
            </div>
            <div class="lg:flex flex-grow items-center" :class="[navbarOpen ? 'block' : 'hidden']"
                id="example-navbar-warning">
                <ul class="flex flex-col lg:flex-row items-center lg:items-start list-none lg:ml-auto">
                    <li class="flex items-center flex-col lg:flex-row justify-between gap-2">
                        <router-link to="/">
                            <p
                                class="hover:text-blueGray-500 text-gray-400 px-3 py-2 flex items-center text-xs uppercase font-bold">
                                Home
                            </p>
                        </router-link>

                        <router-link to="/events">
                            <p
                                class="hover:text-blueGray-500 text-gray-400 px-3 py-2 flex items-center text-xs uppercase font-bold">
                                Events
                            </p>
                        </router-link>
                    </li>
                    <li class="flex items-center">
                        <a class="hover:text-gray-200 text-white px-3 py-2 flex items-center text-xs uppercase font-bold"
                            href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdemos.creative-tim.com%2Fvue-notus%2F%23%2F"
                            target="_blank">
                            <i class="text-gray-400 fab fa-facebook text-lg leading-lg" />
                            <span class="lg:hidden inline-block ml-2">Share</span>
                        </a>
                    </li>

                    <li class="flex items-center">
                        <a class="hover:text-gray-200 text-white px-3 py-2 flex items-center text-xs uppercase font-bold"
                            href="https://twitter.com/intent/tweet?url=https%3A%2F%2Fdemos.creative-tim.com%2Fvue-notus%2F%23%2F&text=Start%20your%20development%20with%20a%20Free%20Tailwind%20CSS%20and%20VueJS%20UI%20Kit%20and%20Admin.%20Let%20Vue%20Notus%20amaze%20you%20with%20its%20cool%20features%20and%20build%20tools%20and%20get%20your%20project%20to%20a%20whole%20new%20level.%20"
                            target="_blank">
                            <i class="text-gray-400 fa-brands fa-x-twitter text-lg leading-lg" />
                            <span class="lg:hidden inline-block ml-2">Tweet</span>
                        </a>
                    </li>

                    <li class="flex items-center">
                        <a class="hover:text-gray-200 text-white px-3 py-2 flex items-center text-xs uppercase font-bold"
                            href="https://github.com/creativetimofficial/vue-notus?ref=vn-index-navbar" target="_blank">
                            <i class="text-gray-400 fab fa-github text-lg leading-lg" />
                            <span class="lg:hidden inline-block ml-2">Star</span>
                        </a>
                    </li>

                    <div v-if="isAuthenticated">
                        <profileIcon />
                    </div>
                    <div v-else>
                        <authModal />
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import IndexDropdown from "./IndexDropdown.vue";
import authModal from "../auth/authModal.vue";
import AuthModal from "../auth/authModal.vue";
import { mapGetters, mapActions } from 'vuex';
import profileIcon from "../misc/profileIcon.vue";

export default {
    data() {
        return {
            navbarOpen: false,
        };
    },
    computed: {
        // Map isAuthenticated getter from Vuex store
        ...mapGetters('auth', ['isAuthenticated']),
        // Map token getter from Vuex store
        ...mapGetters('auth', ['token']),
    },
    methods: {
        ...mapActions('auth', ['logOut']),
        setNavbarOpen: function () {
            this.navbarOpen = !this.navbarOpen;
        },
    },
    components: {
        IndexDropdown,
        authModal,
        profileIcon,
    },
};
</script>