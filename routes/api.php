<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'RegisterController@register');
Route::post('/login', 'LoginController@login');
Route::Post('/logout', 'LoginController@logout');

// service
Route::Post('/sregister', 'ServiceController@create');
Route::get('/sshow', 'ServiceController@index');
Route::post('/sdestroy/{id}', 'ServiceController@destroy');
Route::get('/sedit/{id}', 'ServiceController@edit');
Route::post('/supdate/{id}', 'ServiceController@update');

// client
Route::Post('/cregister', 'clientController@create');
Route::get('/cshow', 'clientController@index');
Route::post('/cdestroy/{id}', 'clientController@destroy');
Route::get('/cedit/{id}', 'clientController@edit');
Route::post('/cupdate/{id}', 'clientController@update');


// employee
Route::Post('/eregister', 'EmployeeController@create');
Route::get('/eshow', 'EmployeeController@index');
Route::post('/edestroy/{id}', 'EmployeeController@destroy');
Route::get('/eedit/{id}', 'EmployeeController@edit');
Route::post('/eupdate/{id}', 'EmployeeController@update');
Route::post('/eterminate/{id}', 'EmployeeController@store');


// Associates
Route::Post('/aregister', 'AssociateController@create');
Route::get('/ashow', 'AssociateController@index');
Route::post('/adestroy/{id}', 'AssociateController@destroy');
Route::get('/aedit/{id}', 'AssociateController@edit');
Route::post('/aupdate/{id}', 'AssociateController@update');

// contractor
Route::Post('/oregister', 'ContractorController@create');
Route::get('/oshow', 'ContractorController@index');
Route::post('/odestroy/{id}', 'ContractorController@destroy');
Route::get('/oedit/{id}', 'ContractorController@edit');
Route::post('/oupdate/{id}', 'ContractorController@update');


// invoice
Route::Post('/iregister', 'InvoiceController@create');
Route::get('/ishow', 'InvoiceController@index');
Route::post('/idestroy/{id}', 'InvoiceController@destroy');
Route::get('/iedit/{id}', 'InvoiceController@show');
Route::post('/iupdate/{id}', 'InvoiceController@update');

// tax
Route::Post('/tregister', 'TaxController@create');
Route::get('/tshow', 'TaxController@index');
Route::post('/tdestroy/{id}', 'TaxController@destroy');
// Route::get('/iedit/{id}', 'InvoiceController@show');
Route::post('/tupdate/{id}', 'TaxController@update');