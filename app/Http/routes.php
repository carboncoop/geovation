<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/styles', function () {
    return view('styles');
});

Route::get('/how-it-works', function () {
    return view('how-it-works');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/overview', function () {
    return view('overview');
});

Route::get('/results', function () {
    return view('results');
});

Route::get('/form', function () {
    return view('form');
});

Route::get('/map', function () {
    return view('map');
});

Route::get('/protool', function () {
    return view('protool-integration');
});

// Route::model('os-addresses', 'App\OSAddress');
Route::get('os-addresses/postcode', 'OSAddressesController@postcode');
Route::get('os-addresses/{osID}', 'OSAddressesController@building');
Route::get('os-addresses/results/{osID}', 'OSAddressesController@results');
Route::get('os-addresses', 'OSAddressesController@index');