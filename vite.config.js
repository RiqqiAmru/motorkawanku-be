import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        hmr: false,
        host: "localhost",
        port: 5173,
    },
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/leaflet.css",
                "resources/js/app.js",
                "resources/js/appLivewire.js",
                "resources/js/leaflet.js",
            ],
            refresh: false,
        }),
    ],
});
