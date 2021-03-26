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
mix.setPublicPath('assets/');

// Disable generation of LICENCE files
// see: https://github.com/JeffreyWay/laravel-mix/issues/2304#issuecomment-572363432
mix.options({
    terser: {
        extractComments: false,
    }
});

// Styles
mix.sass('assets/sass/app.scss', 'css/app.min.css');

// Scripts
mix.js('assets/js/app.js', 'js/app.min.js');
mix.js('assets/js/events-map.js', 'js/events-map.min.js');

// Directly copy assets
mix.copy('node_modules/iframe-resizer/js/iframeResizer.contentWindow.min.js', 'assets/js/iframeResizer.contentWindow.min.js');
