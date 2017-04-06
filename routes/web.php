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
    return view('articles.index');
});*/
Route::get('/', 'ArticleController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('articles', 'ArticleController');

Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function () {
    Route::resource('categories', 'CategoryController');
    Route::resource('tags', 'TagController');
    Route::get('/articles', 'Admin\ArticleController@index');
});
