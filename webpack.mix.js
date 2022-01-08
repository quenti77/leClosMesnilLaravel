const mix = require('laravel-mix');
const {postCss} = require("laravel-mix");
mix.disableNotifications();

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/intlTelInput.js', 'public/js')
    .js('resources/js/datePicker', 'public/js')
    .js('resources/js/fullCalendar', 'public/js')
    .js('resources/js/counterButton', 'public/js')
    .js('resources/js/clearTextarea', 'public/js')
    .js('resources/js/passwordChecker', 'public/js')
    .js('resources/js/updateEditComment', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    
module.exports = {
    plugins: [
        require('postcss-custom-properties')({
            preserve: false, // completely reduce all css vars
            importFrom: [
                'resources/sass/app.scss' // look here for the new values
            ]
        }),
        require('postcss-calc')
    ]
}
mix.postCss('resources/css/main.css', 'public/css')

