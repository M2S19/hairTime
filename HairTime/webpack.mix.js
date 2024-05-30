const mix = require('laravel-mix');

// Compiler les fichiers JavaScript en utilisant React
mix.js('resources/js/app.js', 'public/js')
    .react()  // Ajoutez cette méthode pour supporter React
    .sass('resources/sass/app.scss', 'public/css'); // Compiler les fichiers SASS en CSS
