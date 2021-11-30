const mix = require('laravel-mix');
mix.disableNotifications();
mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/intlTelInput.js', 'public/js')
    .js('resources/js/datePicker', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css');

