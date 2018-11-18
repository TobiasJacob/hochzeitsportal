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

Auth::routes();


Route::get('/admin', 'AdminController@index')->middleware('is_admin');

Route::post('/admin/categories/newCategory', 'AdminCategoriesController@create')->middleware('is_admin');
Route::post('/admin/categories/{id}', 'AdminCategoriesController@edit')->middleware('is_admin');
Route::delete('/admin/categories/{id}', 'AdminCategoriesController@delete')->middleware('is_admin');
Route::get('/admin/categories', 'AdminCategoriesController@index')->middleware('is_admin');

Route::post('/admin/newVendor', 'AdminController@create')->middleware('is_admin');
Route::get('/admin/newVendor', 'AdminController@createView')->middleware('is_admin');
Route::get('/admin/{id}/deleteDetailPhoto/{path}', 'AdminController@deleteDetailPhoto')->middleware('is_admin');
Route::post('/admin/{id}/detailPhoto', 'AdminController@editDetailPhotos')->middleware('is_admin');
Route::delete('/admin/{id}', 'AdminController@delete')->middleware('is_admin');
Route::get('/admin/{id}', 'AdminController@editView')->middleware('is_admin');
Route::post('/admin/{id}', 'AdminController@edit')->middleware('is_admin');

Route::get('/impressum', 'HomeController@impressum')->name('impressum');
Route::get('/kontakt', 'HomeController@kontakt')->name('kontakt');
Route::get('/datenschutz', 'HomeController@datenschutz')->name('datenschutz');
Route::get('/{id}', 'HomeController@show');
Route::get('/', 'HomeController@index')->name('home');
