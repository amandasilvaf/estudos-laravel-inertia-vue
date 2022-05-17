/* eslint-disable import/no-extraneous-dependencies */
import { defineConfig } from 'vite';

import laravel from 'vite-plugin-laravel';
import vue from '@vitejs/plugin-vue';

import autoprefixer from 'autoprefixer';
// import eslintPlugin from 'vite-plugin-eslint';

import watchAndRun from '@kitql/vite-plugin-watch-and-run';

import { generateZiggyRoutesCommand } from './resources/scripts/libs/ziggy';
import { inertia } from './resources/scripts/libs/vite';

export default defineConfig({
  plugins: [
    inertia(),
    vue(),
    // eslintPlugin(),
    laravel({
      postcss: [autoprefixer()],
    }),
    watchAndRun([
      {
        watch: '**/routes/**/*.php',
        run: generateZiggyRoutesCommand,
        watchKind: ['ADD', 'CHANGE', 'DELETE'],
      },
      {
        watch: '**/app/Providers/RouteServiceProvider.php',
        run: generateZiggyRoutesCommand,
        watchKind: ['CHANGE'],
      },
    ]),
  ],
});
