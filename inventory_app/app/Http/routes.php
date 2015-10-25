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
    return redirect('dashboard');
}); 

Route::controller('dashboard', 'DashboardController');

Route::resource('invoice', 'InvoiceController');
Route::resource('delivered', 'DeliveredController');
Route::resource('detail', 'DetailController');
Route::resource('quantity', 'QuantityController');
Route::resource('export', 'ExportController');

Route::resource('settings/size_matrix', 'SizeMatrixController');
Route::resource('settings/price_rule', 'PriceRuleController');
Route::controller('settings/{option}', 'OptionsController' );

// Route::controller('settings/department', 'OptionsController');
// Route::controller('settings/category', 'OptionsController');
// Route::controller('settings/vendor', 'OptionsController');


Route::get('view/{option}', 'SelectController@Index');
Route::get('dd', 'DDController@index');
