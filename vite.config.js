import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/vendor/jquery/jquery.min.js',
                'resources/vendor/jquery-easing/jquery.easing.min.js',
                'resources/vendor/chart.js/Chart.min.js',
                'resources/vendor/bootstrap/js/bootstrap.bundle.min.js',
                'resources/vendor/fontawesome-free/css/all.min.css',
                'resources/css/sb-admin-2.css',
                'resources/js/sb-admin-2.js',
            ],
            refresh: true,
        }),
    ],
});
