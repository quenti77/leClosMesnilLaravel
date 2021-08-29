const mix = require('laravel-mix');
mix.disableNotifications();
mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

