import { defineConfig } from 'astro/config';

// https://astro.build/config
export default defineConfig({
    i18n:{
        defaultLocale: 'en',
        locales: ['en','nl'],
        routing:{ prefixDefaultLocale : false}
    },
    resolve: {
        alias: {
          '@': './src', // o la ruta correspondiente
        },
      },
});

