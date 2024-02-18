import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/myapp.css',
                'resources/js/app.js',
                'public/assets/js/guest.js',
            ],
            refresh: true,
        }),
    ],
});
