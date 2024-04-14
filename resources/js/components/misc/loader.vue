<template>
    <div class="flex flex-row gap-2">
        <div class="w-4 h-4 rounded-full bg-white/20 animate-bounce"></div>
        <div class="w-4 h-4 rounded-full bg-white/20 animate-bounce [animation-delay:-.3s]"></div>
        <div class="w-4 h-4 rounded-full bg-white/20 animate-bounce [animation-delay:-.5s]"></div>
    </div>
</template>

<script>

export default {
    name: 'loader'
};
</script>