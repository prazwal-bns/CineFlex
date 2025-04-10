import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import livewire from '@defstudio/vite-livewire-plugin'; // <-- import

export default defineConfig({
    plugins: [
        laravel({
            // input: ['resources/css/app.css', 'resources/js/app.js'],
            // refresh: true,
            input: [
                'resources/css/app.css',
                'resources/css/admin.css',
                'resources/js/app.js',
            ],
            refresh: false,
        }),

        livewire({  // <-- add livewire plugin
            refresh: ['resources/css/app.css', 'resources/css/admin.css'],  // <-- will refresh css (tailwind ) as well
        }),
        tailwindcss(),
    ],
});
