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
//
//mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css')
//    .sourceMaps();

// in order to mix all of javascript files in 1 one which name is app.js located in public folder.
mix.scripts(
[ 'resources/js/1.js',
  'resources/js/2.js',
  'resources/js/3.js',
  'resources/js/4.js',
]
, 'public/app.js') ;

// in order to mix all of css files in 1 one which name is app.css located in public folder.
mix.styles(
[ 'resources/js/1.css',
  'resources/js/2.css',
  'resources/js/3.css',
  'resources/js/4.css',
]
, 'public/app.css') ;

// ** at the END run the laravel mix with one of these commands in CMD (npm run dev) OR with (npm run production) OR with (npm run watch)