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

/*Route::get('/', function () {
    return view('test');
});*/
Route::get('/','CustomerController@customerShowList');
Route::post('/add-new-form','CustomerController@emergencyAddForm');
Route::post('/delete-form/{id}','CustomerController@deleteData');
Route::post('/edit-form/{id}','CustomerController@editForm');
Route::get('/export-excel-records','CustomerController@ExportExcel');
Route::get('/export-csv-records','CustomerController@exportcsv');
Route::get('/export-pdf','CustomerController@exportPdf');
Route::get('/reorder/{str1}/{str2}','CustomerController@reorder');