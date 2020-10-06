const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.react('resources/site/js/app.js', 'public/site/js')
    .sass('resources/site/sass/app.scss', 'public/site/css');

mix.js('resources/admin/js/app.js', 'public/admin-assets/js')
    .sass('resources/admin/scss/app.scss', 'public/admin-assets/css');

mix.js('resources/lp/js/app.js', 'public/lp/js')
    .sass('resources/lp/scss/style.scss', 'public/lp/css');
