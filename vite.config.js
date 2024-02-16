import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/sass/app.scss',
                'resources/css/admin_custom.css',
                'resources/js/usuario.js',
                'resources/js/admin_custom.js',

            ],
            refresh: true,
        }),
    ],
});
