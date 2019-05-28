<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router->put('/store/{number}', 'RomanatorController@store')->name('store');
$router->get('/show/{number}', 'RomanatorController@show')->name('show');

$router->get('/recent/', 'RomanatorController@recent')->name('recent');
$router->get('/top/', 'RomanatorController@topRated')->name('topResults');
