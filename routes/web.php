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

Route::get('/', 'PagesController@index');
Route::get('/instructions', 'PagesController@instructions');
Route::get('/search', 'PagesController@search');

Route::resource('products','ProductsController');

Route::get('/products/{id}/report','ProductsController@report');
Route::post('/user/{id}/comment/{comment_id}','CommentsController@report');

Route::get('/products-reported','DashboardController@reportedProducts');
Route::get('/comments-reported','DashboardController@reportedComments');

Route::get('/products-reported/{id}','ProductsController@removeReport');
Route::get('/comments-reported/{id}','CommentsController@removeReport');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::get('/user/{id}','UserController@show');
Route::put('/user/{id}','UserController@update');
Route::delete('/user/{id}','UserController@destroy');
Route::get('/user/{id}/edit','UserController@edit');
Route::get('/user/{id}/password-change','UserController@passwordChange');
Route::put('/user/{id}/password','UserController@updatePassword');

Route::get('/user/{id}/comment/','CommentsController@create');
Route::post('/user/{id}/comment/','CommentsController@store');
Route::delete('/user/{id}/comment/{comment_id}','CommentsController@destroy');


