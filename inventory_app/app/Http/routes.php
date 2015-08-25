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

Route::get('dashboard', function () {
    return view('dashboard');
});

Route::resource('invoice', 'InvoiceController');
Route::resource('quantity', 'QuantityController');
Route::resource('detail', 'DetailController');

Route::resource('size_matrix', 'SizeMatrixController');
Route::resource('export', 'ExportController');
Route::resource('delivered', 'DeliveredController');

//Route::resource('select', 'SizeMatrixController');


Route::get('view/{option}', 'SelectController@Index');
Route::get('dd', 'DDController@index');
