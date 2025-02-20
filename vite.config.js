import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/scss/app.scss",
                "resources/scss/admin.scss",
                "resources/scss/landingPage/auth.scss",
                "resources/js/app.ts",
                "resources/scss/landingPage/app.scss",
                "resources/scss/landingPage/eventDetails.scss",
            ],
            refresh: true,
        }),
    ],
});
