<template>
    <router-link :to="`/event/${event.slug}`">
      <div class="relative flex w-80 flex-col h-full justify-start rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
        <div class="relative mx-4 -mt-6 h-40 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40 bg-gray-100/35">
          <img :src="event.image" alt="Event Image" class="w-full h-full mb-1 rounded-t-md">
        </div>
        <div class="p-6">
          <h5 class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">{{ event.name }}</h5>
          <p class="text-gray-600 text-xs mb-2 gap-2 flex flex-row items-center">
            <i class="fa-regular fa-calendar-days"></i>
            {{ new Date(event.created_at).toDateString() }}
          </p>
          <p class="font-sans text-base capitalize text-gray-400 font-semibold text-ellipsis line-clamp-3 leading-relaxed text-inherit antialiased">{{ event.description }}</p>
        </div>
        <div class="absolute -bottom-10 p-6 pt-0 hidden">
          <button data-ripple-light="true" type="button" class="select-none w-full rounded-lg bg-blue-500 py-3 px-6 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">Book</button>
        </div>
      </div>
    </router-link>
  </template>
  
  <script>
  export default {
    name: 'EventCard',
    props: {
      event: Object
    }
  };
  </script>
  