import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import postcss from '@vituum/vite-plugin-postcss';
import tailwindcss from 'tailwindcss';

export default defineConfig({
  plugins: [
    laravel(['resources/js/app.js']),
    vue(),
  ],
});