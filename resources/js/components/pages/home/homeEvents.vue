<template>
    <div class="md:w-10/12 w-full">
        <div class="px-10 mt-10 py-5">
            <div v-if="loading" class="flex py-10 text-center justify-center w-full items-center ">
                <loader />
            </div>
            <div class="flex flex-wrap gap-10 justify-center">
                <EventCard v-for="event in data" :key="event.id" :event="event" />
            </div>
            <div v-if="data.length > 0" class="w-full flex justify-center items-center">
                <router-link to="/events">
                    <div
                        class="relative my-10 hover:border-sky-600 duration-500 group cursor-pointer text-sky-50  overflow-hidden h-14 w-56 rounded-md bg-sky-800 p-2 flex justify-center items-center font-extrabold">
                        <div
                            class="absolute z-10 w-48 h-48 rounded-full group-hover:scale-150 transition-all  duration-500 ease-in-out bg-sky-900 delay-150 group-hover:delay-75">
                        </div>
                        <div
                            class="absolute z-10 w-40 h-40 rounded-full group-hover:scale-150 transition-all  duration-500 ease-in-out bg-sky-800 delay-150 group-hover:delay-100">
                        </div>
                        <div
                            class="absolute z-10 w-32 h-32 rounded-full group-hover:scale-150 transition-all  duration-500 ease-in-out bg-sky-700 delay-150 group-hover:delay-150">
                        </div>
                        <div
                            class="absolute z-10 w-24 h-24 rounded-full group-hover:scale-150 transition-all  duration-500 ease-in-out bg-sky-600 delay-150 group-hover:delay-200">
                        </div>
                        <div
                            class="absolute z-10 w-16 h-16 rounded-full group-hover:scale-150 transition-all  duration-500 ease-in-out bg-sky-500 delay-150 group-hover:delay-300">
                        </div>
                        <p class="z-10">Discover More</p>
                    </div>
                </router-link>
                    
            </div>
        </div>
    </div>
</template>

<script>
import axios from '../../../axios';
import loader from '../../misc/loader.vue';
import EventCard from '../../misc/eventCard.vue';

export default {
    name: 'HomeEvents',
    data() {
        return {
            loading: false,
            data: []
        };
    },
    components: {
        loader,
        EventCard
    },
    created() {
        this.fetchData();
    },
    methods: {
        async fetchData() {
            try {
                this.loading = true
                const response = await axios.get('events?pageSize=3'); // Replace with your endpoint
                this.data = response.data.data;
                console.log(response.data.data);
            } catch (error) {
                console.error(error);
            } finally {
                this.loading = false;
            }
        }
    }
};
</script>