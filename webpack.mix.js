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

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', []);
mix.react('resources/js/user/registeruser.js','public/js/user/registeruser.js');
mix.react('resources/js/user/login.js','public/js/user/login.js');
mix.react('resources/js/pure.js','public/js/user/pure.js');
mix.react('resources/js/user/profile.js','public/js/user/profile.js');
