import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { createSvgIconsPlugin } from 'vite-plugin-svg-icons';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss', 
                'resources/js/app.js',
                'resources/css/filament/admin/theme.css',
            ],
            refresh: true,
        }),
        createSvgIconsPlugin({
            "iconDirs": [path.resolve(process.cwd(), 'resources/icons')],
            "symbolId": 'icon-[dir]-[name]',
        }),
    ],
});
