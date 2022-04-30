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

mix.js('resources/js/app.js', 'public/js')
    .minify('resources/js/up.js', 'public/js/up.js')
    .sass('resources/css/admin/admin.scss', 'public/css/admin.css')
    .sass('resources/css/front/common.scss', 'public/css/layout.css')
    .vue()
  .postCss('resources/css/app.css', 'public/css', [
    //
]);

