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

mix.setResourceRoot('/themes/repair-cafe/assets/');
mix.setPublicPath('themes/repair-cafe/assets/');
mix.js('themes/repair-cafe/assets/js/app.js', 'js/app-compiled.js')
    .sass('themes/repair-cafe/assets/sass/app.scss', 'css/app.min.css')
    .combine([
        'node_modules/jquery/dist/jquery.js',
        'node_modules/tether/dist/js/tether.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'themes/repair-cafe/assets/js/app-compiled.js'
    ], 'themes/repair-cafe/assets/js/app.min.js');
