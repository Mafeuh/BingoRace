require('dotenv').config();
const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .scripts('resources/js/bootstrap.js', 'public/js/bootstrap.js')
   .version();

mix.browserSync('bingorace.test');
mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
});