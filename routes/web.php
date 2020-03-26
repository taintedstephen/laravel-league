<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'TableController@index');
Route::get('/rules', 'StaticController@rules');

Route::group(['prefix' => 'fixtures'], function() {
	Route::get('/', 'FixtureController@index');
	Route::get('/player/{id}', 'FixtureController@player');
});

Auth::routes([
	'register' => false,
]);

Route::group(['prefix' => 'users'], function() {
	Route::get('/', 'UserController@index');
	Route::get('/new', 'UserController@new');
	Route::post('/create', 'UserController@create');
	Route::get('/edit/{id}', 'UserController@edit');
	Route::post('/update', 'UserController@update');
	Route::post('/remove', 'UserController@remove');
});

Route::group(['prefix' => 'players'], function() {
	Route::get('/', 'PlayerController@index');
	Route::get('/new', 'PlayerController@new');
	Route::post('/create', 'PlayerController@create');
	Route::get('/edit/{id}', 'PlayerController@edit');
	Route::post('/update', 'PlayerController@update');
	Route::post('/remove', 'PlayerController@remove');
});

Route::group(['prefix' => 'divisions'], function() {
	Route::get('/', 'DivisionController@index');
	Route::get('/new', 'DivisionController@new');
	Route::post('/create', 'DivisionController@create');
	Route::get('/edit/{id}', 'DivisionController@edit');
	Route::post('/update', 'DivisionController@update');
	Route::post('/remove', 'DivisionController@remove');
	Route::get('/players', 'DivisionController@players');
	Route::post('/save-players', 'DivisionController@savePlayers');
});

Route::group(['prefix' => 'results'], function() {
	Route::get('/', 'ResultController@index');
	Route::get('/generate', 'ResultController@generate');
	Route::post('/save-generated', 'ResultController@saveGenerated');
	Route::post('/empty', 'ResultController@emptyAll');
	Route::get('/edit/{id}', 'ResultController@edit');
	Route::post('/update', 'ResultController@update');
});
