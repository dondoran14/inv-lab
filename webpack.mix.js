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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

// Nuevos agregados por JV 2022

// mix.js('resources/assets/js/app.js', 'public/js')
//     .sass('resources/assets/sass/app.scss', 'public/css')
//     .copy('node_modules/material-icons/css/material-icons.min.css', 'public/css/material-icons.min.css'); 