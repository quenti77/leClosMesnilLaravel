const mix = require('laravel-mix');
const path = require('path/posix');

mix.setPublicPath('public')
mix.setResourceRoot('../')

mix.disableNotifications()

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/intlTelInput.js', 'public/js')
    .js('resources/js/datePicker', 'public/js')
    .js('resources/js/fullCalendar', 'public/js')
    .js('resources/js/infiniteScroll', 'public/js')
    .js('resources/js/counterButton', 'public/js')
    .js('resources/js/clearTextarea', 'public/js')
    .js('resources/js/passwordChecker', 'public/js')
    .js('resources/js/updateEditComment', 'public/js')
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

mix
    /* CSS */
    .sass('resources/sass/main.scss', 'public/css/codebase.css')

    /* JS */
    .js('resources/js/codebase/app.js', 'public/js/codebase.app.js')
    .js('resources/js/admin.jsx', 'public/js')
    .react()

    /* Options */
    .options({
        processCssUrls: false
    })
    .alias({
        '@adminComponent': path.join(__dirname, 'resources/js/admin/components')
    })

