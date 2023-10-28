import {defineConfig} from "vite";

export default defineConfig({
    build: {
        outDir: './public/dist',
        manifest: true,
        rollupOptions: {
            input: [
                './assets/main.js',
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