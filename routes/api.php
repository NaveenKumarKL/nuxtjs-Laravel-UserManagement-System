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