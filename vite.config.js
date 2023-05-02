import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { fileURLToPath, URL } from "node:url";

export default defineConfig({
    plugins: [
        laravel({
            publicDirectory: "../public_html",
            input: ["resources/sass/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
                compilerOptions: {
                    isCustomElement: (tag) => {
                        return tag.startsWith("Bootstrap5Pagination"); // (return true)
                    },
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: "vue/dist/vue.esm-bundler.js",
            "@": "/resources/js",
            asset: fileURLToPath(new URL("./public/assets", import.meta.url)),
        },
    },
});
