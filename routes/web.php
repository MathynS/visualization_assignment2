<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('map');
});

Route::get('/map', function () {
    return view('map');
});

Route::get('/chart', function () {
    return view('area');
});

Route::prefix('data')->group(function() {
    Route::get('cache/states', 'StateController@cache_retrieve');
    Route::get('states', 'StateController@retrieve');
});
