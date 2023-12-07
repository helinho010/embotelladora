import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/bootstrap/css/bootstrap.css', 'resources/bootstrap/js/bootstrap.min.js', 'resources/bootstrap-icons/font/bootstrap-icons.min.css'],
            refresh: true,
        }),
    ],
});
