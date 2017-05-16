const { mix } = require('laravel-mix');

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
   .sass('resources/assets/sass/app.scss', 'public/css')
   .combine([
     'public/tpl/eliteadmin/bootstrap/dist/css/bootstrap.css',
     'public/tpl/eliteadmin/plugins/sidebar-nav/dist/sidebar-nav.css'
   ], 'public/css/vendor.css')
   .combine([
     'public/tpl/eliteadmin/css/spinners.css',
     'public/tpl/eliteadmin/css/style.css',
     'public/tpl/eliteadmin/css/colors/gray.css'
   ], 'public/tpl/eliteadmin/css/eliteadmin.css')
   .combine([
     'public/tpl/eliteadmin/plugins/jquery/dist/jquery.js',
     'public/tpl/eliteadmin/bootstrap/dist/js/bootstrap.js',
     'public/tpl/eliteadmin/plugins/sidebar-nav/dist/sidebar-nav.js',
     'public/tpl/eliteadmin/js/jquery.slimscroll.js',
     'public/tpl/eliteadmin/js/custom.js'
   ], 'public/tpl/eliteadmin/js/eliteadmin.js')
;
