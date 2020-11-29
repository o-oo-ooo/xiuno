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

mix.styles('resources/css/bootstrap.css', 'public/css/bootstrap.css')
    .styles('resources/css/bootstrap-bbs.css', 'public/css/bootstrap-bbs.css')
    .scripts('resources/js/jquery-3.1.0.js', 'public/js/jquery-3.1.0.js')
    .scripts('resources/js/popper.js', 'public/js/popper.js')
    .scripts('resources/js/bootstrap.js', 'public/js/bootstrap.js')
    .scripts('resources/js/xiuno.js', 'public/js/xiuno.js')
    .scripts('resources/js/bootstrap-plugin.js', 'public/js/bootstrap-plugin.js')
    .scripts('resources/js/async.js', 'public/js/async.js')
    .scripts([
        'resources/js/bbs.js',
        'resources/js/bbs-cn.js'
    ], 'public/js/bbs.js')
    .scripts('resources/js/form.js', 'public/js/form.js');
    