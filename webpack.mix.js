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
        'node_modules/popper.js/dist/umd/popper.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'node_modules/jquery.easing/jquery.easing.min.js',
        'themes/repair-cafe/assets/js/app-compiled.js'
    ], 'themes/repair-cafe/assets/js/app.min.js');

mix.js('themes/repair-cafe/assets/js/events-map.js', 'js/events-map-compiled.js')
    .combine([
        'node_modules/leaflet/dist/leaflet.js',
        'node_modules/leaflet.markercluster/dist/leaflet.markercluster.js',
        'node_modules/leaflet.locatecontrol/dist/L.Control.Locate.min.js',
        'themes/repair-cafe/assets/js/events-map-compiled.js'
    ], 'themes/repair-cafe/assets/js/events-map.min.js');
mix.copy('node_modules/jquery/dist/jquery.js', 'themes/repair-cafe/assets/js/jquery.min.js');
mix.copy('node_modules/leaflet/dist/images', 'themes/repair-cafe/assets/images/vendor/leaflet/dist');
