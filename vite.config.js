import {defineConfig} from "vite";

export default defineConfig({
    build: {
        outDir: './public/build',
        manifest: true,
        rollupOptions: {
            input: [
                './assets/js/app.js',
            ]
        },
    },

    server: {
        host: true,
        hmr: {
            host: 'localhost',
        },
    }
})