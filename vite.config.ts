import { wayfinder } from '@laravel/vite-plugin-wayfinder';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';
import imageminWebp from 'imagemin-webp';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';
import compression from 'vite-plugin-compression';
import viteImagemin from 'vite-plugin-imagemin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/app.ts'],
            ssr: 'resources/js/ssr.ts',
            refresh: true,
        }),
        tailwindcss(),
        wayfinder({
            formVariants: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        viteImagemin({
            plugins: [
                imageminWebp({
                    quality: 80,
                    preset: 'default',
                }),
            ],
            filter: (file) => {
                // Process images from resources directory
                return (
                    file.includes('resources/') &&
                    (file.endsWith('.jpg') ||
                        file.endsWith('.jpeg') ||
                        file.endsWith('.png') ||
                        file.endsWith('.gif'))
                );
            },
        }),
        compression({
            algorithm: 'gzip',
            ext: '.gz',
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    const info = assetInfo.name.split('.');
                    const ext = info[info.length - 1];
                    if (
                        /\.(mp4|webm|ogg|mp3|wav|flac|aac)(\?.*)?$/i.test(
                            assetInfo.name,
                        )
                    ) {
                        return `media/[name]-[hash][extname]`;
                    }
                    if (
                        /\.(png|jpe?g|gif|svg|webp|avif)(\?.*)?$/i.test(
                            assetInfo.name,
                        )
                    ) {
                        return `images/[name]-[hash][extname]`;
                    }
                    if (
                        /\.(woff2?|eot|ttf|otf)(\?.*)?$/i.test(assetInfo.name)
                    ) {
                        return `fonts/[name]-[hash][extname]`;
                    }
                    return `assets/[name]-[hash][extname]`;
                },
            },
        },
    },
});
