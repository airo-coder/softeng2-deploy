import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { globSync } from 'glob';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...globSync('resources/css/**/*.css'),
                ...globSync('resources/js/**/*.js'),
            ],
            refresh: true,
        }),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
