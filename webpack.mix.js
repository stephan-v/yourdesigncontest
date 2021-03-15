const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css', {
        implementation: require('node-sass'),
    })
    .disableNotifications();

if (mix.inProduction()) {
    mix.version();
} else {
    mix.sourceMaps(true, 'cheap-module-inline-source-map');
}

/*
 |--------------------------------------------------------------------------
 | ESLint configuration
 |--------------------------------------------------------------------------
 |
 | The basic ESLint configuration for the application.
 */

mix.webpackConfig({
    module: {
        rules: [
            {
                enforce: 'pre',
                test: /\.(js|vue)$/,
                loader: 'eslint-loader',
                exclude: /node_modules/,
            },
        ],
    },
});
