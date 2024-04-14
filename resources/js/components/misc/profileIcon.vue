<template>
    <router-link to="/profile">
        <div class="h-8 w-8 rounded-full cursor-pointer bg-slate-700 flex justify-center items-center" title="User profile">
            <i class="fa-regular fa-user text-white"></i>
        </div>

    </router-link>
</template>

<script>
import axios from '../../axios';
import { mapGetters, mapActions } from 'vuex';

export default {
    name: 'ProfileIcon',
    data() {
        return {
            loading: false,
            user: null,
        };
    },
    computed: {
        ...mapGetters('auth', ['token']),
    },
    created() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                console.log('Token:', this.token);
                const response = await axios.get('auth/check');
            } catch (error) {
                console.error(error);
            } finally {
                this.loading = false;
            }
        },
    }
}
</script>