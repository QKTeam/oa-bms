<?php

use Illuminate\Http\Request;

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

Route::post('book', 'BookController@Create');

Route::get('book', 'BookController@List');

Route::get('book/{book_id}', 'BookController@Detail');

Route::put('book/{book_id}', 'BookController@Change');

Route::delete('book/{book_id}', 'BookController@Delete');



Route::put('rent/{book_id}', 'RentController@Rent');

Route::put('revert/{book_id}', 'RentController@revert');

Route::get('rent/list', 'RentController@List');