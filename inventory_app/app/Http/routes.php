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

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', function () {
	    return redirect('dashboard');
	}); 
	Route::get('home', function () {
	    return redirect('dashboard');
	}); 

	Route::controller('dashboard', 'DashboardController');
	Route::controller('history', 'HistoryController');

	Route::resource('invoice', 'InvoiceController');
	Route::resource('delivered', 'DeliveredController');
	Route::resource('detail', 'DetailController');
	Route::resource('quantity', 'QuantityController');
	Route::resource('export', 'ExportController');

	Route::resource('settings/size_matrix', 'SizeMatrixController');
	Route::resource('settings/price_rule', 'PriceRuleController');
	Route::controller('settings/{option}', 'OptionsController' );

	Route::resource('user', 'UserController' );

	// Registration routes...
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');	

	// Password reset routes...
	Route::get('password/reset/{user}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');