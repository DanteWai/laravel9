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



mix.sass('resources/css/app.scss', '/css').options({
    autoprefixer:true
})

mix.js('resources/js/app.js', 'public/js')
mix.js('resources/js/rater.js', 'public/js')
mix.js('resources/js/dashboard.js', 'public/js')
