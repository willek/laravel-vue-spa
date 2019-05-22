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

Route::group(['as' => 'books.', 'prefix' => '/books'], function () {
    Route::get('/', 'Api\BooksController@index')->name('index');
    Route::post('/created', 'Api\BooksController@created')->name('created');
    Route::get('/{book}', 'Api\BooksController@show')->name('show');
    Route::put('/{book}', 'Api\BooksController@update')->name('update');
    Route::delete('/{book}', 'Api\BooksController@destroy')->name('destroy');
});
