<template>
    <div class="relative w-full lg:p-10 py-10 flex content-center items-center justify-center">
        <div class="absolute top-0 w-full h-full bg-center bg-cover" style="
            background-image: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1267&q=80');
          ">
            <span id="blackOverlay" class="w-full h-full absolute opacity-75 bg-black"></span>
        </div>
        <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
                <div class="w-full px-4 ml-auto mr-auto text-center">
                    <div class="pr-12">
                        <h1 class="text-white font-semibold text-4xl capitalize">
                            Unlock unforgettable moments with every ticket
                        </h1>
                        <p class="mt-4 hidden md:block text-lg text-blueGray-200">
                            Welcome to our premier event ticket selling website,
                            where you can discover and secure tickets to the hottest concerts,
                            shows, and sporting events.
                            Experience seamless booking and guaranteed access to your favorite live experiences with
                            just a few clicks!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <homeEvents />
</template>

<script>
import homeEvents from './homeEvents.vue';
export default {
    name: 'Home',
    components: {
        homeEvents
    }
}
</script>