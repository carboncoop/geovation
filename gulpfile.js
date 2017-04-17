var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.sass('app.scss');

	mix.scripts([
        'vendor/protool/openbem-r4.js',
        'vendor/protool/ui-helper-r3.js',
        'vendor/protool/ui-openbem-r3.js',
        'vendor/protool/model/library-r6.js',
        'vendor/protool/model/datasets-r4.js',
        'vendor/protool/model/model-r6.js',
        'vendor/protool/model/appliancesCarbonCoop-r1.js',
        'vendor/geodesy/vector3d.js',
        'vendor/geodesy/latlon-ellipsoidal.js',
        'vendor/geodesy/dms.js',
        'vendor/geodesy/osgridref.js',
        'vendor/chosen.min.js',
        'vendor/Sortable.min.js',
        'map.js',
        'forms.js',
        'bootstrap.js',
        'results.js'
    ]);

});
