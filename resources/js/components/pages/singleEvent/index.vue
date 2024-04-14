<template>
    <div class="text-white min-h-screen pb-10 bg-blueGray-800">
        <div v-if="loading" class="h-56 flex justify-center items-center" >
            <loader />
        </div>
        <div v-if="!loading">
            <div class=" mx-auto">
                <!-- Event Image -->
                <div class="mb-8 h-96 relative flex flex-col justify-end" :style="{
                    backgroundImage: `url(${data.image})`,
                    backgroundSize: 'cover',
                    backgroundRepeat: 'no-repeat',
                    backgroundPosition: 'center'
                }">
                <h1 class=" md:text-4xl backdrop-brightness-50 py-4 text-3xl lg:text-5xl font-bold capitalize px-3">{{ data.name }}</h1>
                </div>
    
                <!-- Event Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <!-- Left Side: Event Description -->
    
                    <!-- Right Side: Event Information -->
                    <div class="space-y-4 p-4 rounded-md shadow-lg border border-white/10 mx-2">
                        <div class="space-y-4">
                            <p class="text-md capitalize text-gray-300">{{ data.description }}
                            </p>
                        </div>
                        <!-- Date -->
                        <div class="flex items-center">
                            <span class="mr-2 "><i class="far fa-calendar-alt"></i></span>
                            <p class="text-lg">{{ new Date(data.created_at).toLocaleString() }}</p>
                        </div>
                        <!-- Location -->
                        <div class="flex items-center">
                            <span class="mr-2 "><i class="fas fa-map-marker-alt"></i></span>
                            <p class="text-lg">{{ data.organiser }}</p>
                        </div>
    
                        <div v-if="location" class="">
                            <div style="overflow:hidden;resize:none;max-width:100%;width:100%;height:200px;">
                                <div id="embed-map-canvas" style="height:100%; width:100%;max-width:100%;">
                                    <iframe id="map-iframe" :src="mUrl" style="height:100%;width:100%;border:0;" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div
                        class="space-y-4 p-4 flex flex-col justify-between rounded-md shadow-lg border border-white/10 mx-2">
                        <div class="">
                            <div class="space-y-4 text-lg underline mb-3">
                                Available Tickets
                            </div>
    
                            <div v-for="ticket in data.tickets" :key="ticket.id" class="flex flex-col">
    
                                <div class="flex flex-row gap-2 border justify-between p-2 mb-2 rounded border-white/10">
                                    <div class="flex flex-col gap-2">
                                        <div class="flex items-center">
                                            <span class="mr-2 "><i class="fa-solid fa-ticket"></i></span>
                                            <p class="text-lg capitalize">{{ ticket.name }}</p>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="mr-2 "><i class="fas fa-money-bill-wave"></i></span>
                                            <p class="text-lg">{{ parseFloat(ticket.price).toLocaleString(('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                })) }} RWF</p>
                                        </div>
    
                                    </div>
    
                                    <div class="flex flex-col items-center justify-center ">
    
                                        <div class="flex flex-row gap-2">
                                            <button @click="increment(ticket.id)"
                                                class="px-1.5 bg-green-500 text-white rounded-full">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
    
                                            <p>{{ getCount(ticket.id) }}</p>
    
                                            <button @click="decrement(ticket.id)"
                                                :class="{ 'px-1.5': true, 'bg-green-500': getCount(ticket.id) > 0, 'bg-gray-500': getCount(ticket.id) <= 0, 'text-white': true, 'rounded-full': true }">
                                                <i class="fa-solid fa-minus"></i>
                                            </button>
                                        </div>
    
                                    </div>
    
                                </div>
    
                            </div>
                        </div>
    
    
                        <button class="w-full bg-blue-600 py-2 rounded">
                            Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from '../../../axios';
import loader from '../../misc/loader.vue';

export default {
    name: 'SingleEvent',
    props: ['slug'],
    data() {
        return {
            loading: false,
            data: null,
            location: false,
            count: [],
            mUrl: '',
        };
    },
    created() {
        this.fetchData();
        this.initializeMap();
    },
    methods: {
        async fetchData() {
            try {
                this.loading = true
                const response = await axios.get(`events/slug/${this.slug}`); // Replace with your endpoint
                this.data = response.data;
            } catch (error) {
                console.error(error);
            } finally {
                this.loading = false;
            }
        },

        async initializeMap() {
            if (navigator.geolocation) {
                this.location = true;
                var url;
                var origin;
                navigator.geolocation.getCurrentPosition((position) => {
                    origin = position.coords.latitude + ',' + position.coords.longitude;
                    var destination = 'BK+ARENA'; // Set your destination coordinates here
                    var apiKey = 'AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8'; // Set your Google Maps API key here
                    url = 'https://www.google.com/maps/embed/v1/directions?origin=' + origin + '&destination=' + destination + '&key=' + apiKey;
                    this.mUrl = url;
                    console.log(this.mUrl); // `this` refers to the Vue component here
                });
            } else {
                this.location = false;
                console.error('Geolocation is not supported by this browser.');
            }
        },

        getCount(ticketId) {
            const countDataItem = this.count.find(item => item.ticket_id === ticketId);
            return countDataItem ? countDataItem.count : 0;
        },

        increment(id) {
            // Check if an item with the same ticket_id already exists in the array
            let existingItem = this.count.find(item => item.ticket_id === id);

            if (existingItem) {
                // If item exists, increment its count
                existingItem.count++;
            } else {
                // If item doesn't exist, add a new item to the array
                this.count.push({
                    ticket_id: id,
                    count: 1
                });
            }
        },

        decrement(id) {
            if (this.getCount(id) >= 1) {
                // Check if an item with the same ticket_id already exists in the array
                let existingItem = this.count.find(item => item.ticket_id === id);

                if (existingItem && existingItem.count > 0) {
                    // If item exists and count is greater than 0, decrement its count
                    existingItem.count--;
                }
            }
        },
    },
    components: {
        loader
    }
}
</script>