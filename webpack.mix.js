let mix = require('laravel-mix');

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

mix.setPublicPath('themes/repair-cafe/assets/')
   .js('themes/repair-cafe/assets/js/app.js', 'js/app.min.js')
   .sass('themes/repair-cafe/assets/sass/app.scss', 'css/app.min.css');
