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

// Styles
mix.sass('themes/repair-cafe/assets/sass/app.scss', 'css/app.min.css');
mix.styles([
    'modules/system/assets/css/framework.extras.css'
], 'themes/repair-cafe/assets/css/framework.extras.min.css');

// Scripts
mix.scripts([
    'node_modules/popper.js/dist/umd/popper.js',
    'node_modules/bootstrap/dist/js/bootstrap.js',
    'themes/repair-cafe/assets/js/app.js'
], 'themes/repair-cafe/assets/js/app.min.js');
mix.scripts([
    'node_modules/leaflet/dist/leaflet-src.js',
    'node_modules/leaflet.markercluster/dist/leaflet.markercluster-src.js',
    'node_modules/leaflet.locatecontrol/src/L.Control.Locate.js',
    'themes/repair-cafe/assets/js/events-map.js'
], 'themes/repair-cafe/assets/js/events-map.min.js');
mix.scripts([
    'modules/system/assets/js/framework.js',
    'modules/system/assets/js/framework.extras.js'
], 'themes/repair-cafe/assets/js/framework.extras.min.js');

// Directly copy assets
mix.copy('node_modules/jquery/dist/jquery.min.js', 'themes/repair-cafe/assets/js/jquery.min.js');
mix.copy('node_modules/leaflet/dist/images', 'themes/repair-cafe/assets/images/vendor/leaflet/dist');
mix.copy('node_modules/iframe-resizer/js/iframeResizer.contentWindow.min.js', 'themes/repair-cafe/assets/js/iframeResizer.contentWindow.min.js');
