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

mix
    .copy('/node_modules/font-awesome/fonts/**/**', 'public/fonts/')
    .copy('./node_modules/datatables.net-bs/css/dataTables.bootstrap.css', 'resources/assets/sass/libs/dataTables.bootstrap.scss')
    .copy('./node_modules/datatables.net-buttons-dt/css/buttons.dataTables.css', 'resources/assets/sass/libs/buttons.dataTables.scss')
    .copy('./node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css', 'resources/assets/sass/libs/bootstrap-datepicker.scss')
    .copy('./node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css', 'resources/assets/sass/libs/bootstrap-datepicker3.scss')
    .copy('./node_modules/icheck-bootstrap/icheck-bootstrap.css', 'resources/assets/sass/libs/icheck-bootstrap.scss')
    .copy('./node_modules/datatables.net-buttons-dt/css/buttons.dataTables.css', 'resources/assets/sass/libs/buttons.dataTables.scss')
    .js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');

// mix.js('resources/assets/js/dismod/app.js', 'public/dismod/js/app.js');
