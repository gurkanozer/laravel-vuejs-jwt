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

mix.js('resources/js/app.js', 'public/backend/js').version()
.sass('resources/sass/backend/app.scss', 'public/backend/css');

mix.js('resources/js/frontend/app.js','public/frontend/js')
.sass('resources/sass/frontend/app.scss','public/frontend/css');