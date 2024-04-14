<template>
    <div class="relative w-full lg:p-10 py-10 flex content-center items-center justify-center">
        <div class="absolute top-0 w-full h-full bg-center bg-cover" style="
            background-attachment: fixed;
            background-image: url('https://t4.ftcdn.net/jpg/04/95/28/65/360_F_495286577_rpsT2Shmr6g81hOhGXALhxWOfx1vOQBa.jpg');
          ">
            <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
        </div>
        <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
                <div class="w-full ml-auto mr-auto text-center">
                    <div class="h-10">
                        <div
                            class="grid grid-cols-2 md:flex flex-wrap gap-5 justify-center items-stretch right- w-full px-3">
                            <div v-for="item in items" @click="handleClick(item.name)" :key="item.id"
                                class="cursor-pointer hover:ring-1 ring-white/75 md:w-48 h-32 bg-slate-700 flex gap-3 flex-col justify-center items-center rounded-md">
                                <i :class="'fa-solid fa-' + item.icon + ' text-3xl'"></i>
                                <div class="">{{ item.name }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    name: 'ProfilePage',
    data() {
        return {
            items: [
                { name: 'Profile', icon: 'user' },
                { name: 'Tickets', icon: 'ticket' },
                { name: 'Notifications', icon: 'bell' },
                { name: 'Log Out', icon: 'right-from-bracket' },
                // Add more items as needed
            ],
            loading: false,
            user: null,
        }
    },
    watch: {
        '$store.getters["auth/isAuthenticated"]': function (newValue) {
            if (!newValue) {
                this.$router.push({ name: 'home' }); // Navigate to homepage
            }
        }
    },
    mounted() {
        this.checkAuthStatus();
    },
    methods: {
        ...mapActions('auth', ['logOut']),
        checkAuthStatus() {
            if (!this.$store.getters['auth/isAuthenticated']) {
                window.location.href = '/'
            }
        },
        handleClick(name) {
            if (name === 'Log Out') {
                this.logOut();
            } else {

            }
        }
    }
}
</script>