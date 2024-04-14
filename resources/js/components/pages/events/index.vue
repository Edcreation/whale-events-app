<template>
    <div class="w-11/12 flex flex-col items-center">
        <!--Search -->
        <div class="flex justify-center py-5 w-full">
            <div class="relative rounded-full overflow-hidden bg-white shadow-xl w-3/4">
                <input type="search" v-model="searchQuery" @input="handleSearch" name="text" placeholder="Search Events"
                    class="input bg-transparent outline-none text-black border-none pl-6 pr-10 py-3 w-full font-sans text-lg font-semibold" />
                <div class="absolute right-[1.5px] top-[0.11em]">
                    <button
                        class="w-12 h-12 rounded-full bg-violet-500 group shadow-xl flex items-center justify-center relative overflow-hidden">
                        <i class="fa-solid fa-magnifying-glass relative z-10"></i>
                        <div
                            class="w-full h-full rotate-45 absolute left-[32%] top-[32%] bg-blue-600 group-hover:-left-[100%] group-hover:-top-[100%] duration-1000">
                        </div>
                        <div
                            class="w-full h-full -rotate-45 absolute -left-[32%] -top-[32%] group-hover:left-[100%] group-hover:top-[100%] bg-blue-800 duration-1000">
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <div class="py-3 mb-10 max-w-[1000px] w-full">
            <h1 class="text-2xl">Browse Popular Events</h1>
        </div>
        <div class="flex flex-col mb-5 justify-center min-h-[300px] w-full">
            <div v-if="loading" class="flex py-10 text-center justify-center w-full items-center ">
                <loader />
            </div>
            <div v-if="!loading" class="flex flex-wrap gap-10 w-full justify-center">
                <EventCard v-for="event in data" :key="event.id" :event="event" />
            </div>

            <!-- Pagination navigation -->
        </div>
        <nav v-if="!loading" class="my-4 mt-7 flex justify-center space-x-4" aria-label="Pagination">
            <!-- Previous page link -->
            <button v-if="!loading" :disabled="!(currentPage > 1)" @click="paginate(currentPage - 1)"
                class="rounded-lg border border-gray-600 px-2 py-2 text-gray-400">
                <span class="sr-only">Previous</span>
                <i class="fa-solid fa-chevron-left px-3"></i>
            </button>

            <!-- Page links -->
            <div v-for="page in totalPages" :key="page">
                <button @click="paginate(page)"
                    :class="['rounded-lg', 'border', 'border-gray-600', page === currentPage ? 'bg-blue-600 text-white' : 'text-gray-400', 'px-4', 'py-2']">
                    {{ page }}
                </button>
            </div>

            <!-- Next page link -->
            <button v-if="!loading" :disabled="(currentPage == totalPages)" @click="paginate(currentPage + 1)"
                class="rounded-lg border border-gray-600 px-2 py-2 text-gray-400">
                <span class="sr-only">Next</span>
                <i class="fa-solid fa-chevron-right px-3"></i>
            </button>
        </nav>
    </div>
</template>

<script>
import axios from '../../../axios';
import loader from '../../misc/loader.vue';
import EventCard from '../../misc/eventCard.vue';

export default {
    name: 'EventsPage',
    data() {
        return {
            loading: false,
            data: [],
            pageSize: 20,
            currentPage: 1,
            totalPages: 0,
            searchQuery: '',
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
                const response = await axios.get(`events?pageSize=${this.pageSize}&page=${this.currentPage}&search=${this.searchQuery}`); // Replace with paginate value
                this.data = response.data.data;
                this.pageSize = response.data.per_page;
                this.totalPages = response.data.page_size > 1 ? response.data.total / response.data.per_page : 1;
                // this.currentPage = response.data.current_page
                console.log({
                    'c': this.currentPage,
                    'size': this.pageSize,
                    'total': this.totalPages,
                });
            } catch (error) {
                console.error(error);
            } finally {
                this.loading = false;
            }
        },
        paginate(page) {
            // Update query parameter for page
            const queryParams = new URLSearchParams(window.location.search);
            queryParams.set('page', page);
            const newUrl = `${window.location.pathname}?${queryParams.toString()}`;

            // Update current page and fetch data for the new page
            this.currentPage = page;
            window.history.pushState({ path: newUrl }, '', newUrl);
            this.fetchData();
        },
        handleSearch() {
            this.fetchData();
        }
    }
}
</script>