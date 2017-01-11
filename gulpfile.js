const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
const jgSource = './resources/';
const jgWatch = [`${jgSource}/*`, `${jgSource}/**/*`, `!${jgSource}/*`];
elixir(mix => {
    mix
        .exec('jigsaw build test', jgWatch)
        //.sass('app.scss')
        //.webpack('app.js');
    ;
});
