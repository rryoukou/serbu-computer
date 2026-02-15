import { defineConfig, loadEnv } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd(), "");
    const appUrl = env.APP_URL || "http://localhost";
    let hmrHost = "localhost";

    try {
        const url = new URL(appUrl);
        if (url.hostname !== "localhost" && url.hostname !== "127.0.0.1") {
            hmrHost = url.hostname;
        }
    } catch (e) {
        // Fallback to localhost
    }

    return {
        plugins: [
            tailwindcss(),
            laravel({
                input: ["resources/css/app.css", "resources/js/app.js"],
                refresh: true,
            }),
        ],
        server: {
            host: "0.0.0.0",
            cors: true,
            hmr: {
                host: env.VITE_HMR_HOST || hmrHost,
            },
        },
    };
});
