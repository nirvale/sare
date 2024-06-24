import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import mkcert from 'vite-plugin-mkcert';  //para ssl dev

export default defineConfig({
    plugins: [
        mkcert(), //para ssl dev
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/sass/app.scss',
                'resources/css/admin_custom.css',
                'resources/js/usuario.js',
                'resources/js/admin_custom.js',
                'resources/js/dominio.js',

            ],
            refresh: true,
        }),
    ],
    //para ssl dev
    server: {
      https: true,
      host: 'appsi.cggedomex.gob.mx',
    },
    //fin ssl dev
});
