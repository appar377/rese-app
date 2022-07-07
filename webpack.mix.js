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
    .postCss('resources/css/app.css', 'public/css',);

mix.postCss('public/css/index.css', 'public/css')

mix.postCss('public/css/default.css', 'public/css')

mix.postCss('public/css/reset.css', 'public/css')

mix.postCss('public/css/menu.css', 'public/css')

mix.postCss('public/css/collation.css', 'public/css')

mix.postCss('public/css/create_shop.css', 'public/css')

mix.postCss('public/css/detail.css', 'public/css')

mix.postCss('public/css/done.css', 'public/css')

mix.postCss('public/css/login.css', 'public/css')

mix.postCss('public/css/management.css', 'public/css')

mix.postCss('public/css/mypage.css', 'public/css')

mix.postCss('public/css/register.css', 'public/css')

mix.postCss('public/css/reserve_confirmation.css', 'public/css')

mix.postCss('public/css/thanks.css', 'public/css')