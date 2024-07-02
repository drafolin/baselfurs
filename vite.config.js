import { fileURLToPath, URL } from 'node:url'

import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import VueDevTools from 'vite-plugin-vue-devtools'

import laravel from 'laravel-vite-plugin';
// https://vitejs.dev/config/
export default defineConfig({
    css: {
        preprocessorOptions: {
            scss: {
                additionalData: '@use "@/css/consts" as *;\n'
            }
        }
    },
    plugins: [vue(), VueDevTools(), laravel({
        input: ['resources/js/app.js'],
        refresh: true,
    }),],
    base: '/build',
    resolve: {
        alias: {
            '@': fileURLToPath(new URL('./resources/', import.meta.url))
        }
    }
})
