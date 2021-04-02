const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.sourceMaps();

mix.js('resources/js/dashboard.jsx', 'public/js')
    .postCss('resources/css/dashboard.css', 'public/css', [
         //
    ])
    .react();
