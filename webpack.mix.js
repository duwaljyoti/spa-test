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

mix.js('resources/assets/js/app.js', 'public/js')
  .js('resources/assets/js/user/app.js', 'build/js/userApp.js')
  .js('resources/assets/js/note/app.js', 'build/js/noteApp.js')
   .sass('resources/assets/sass/app.scss', 'public/css')
  .styles(['resources/assets/css/main-style.css'], 'public/build/css/main-style.css')
;


mix.disableSuccessNotifications();