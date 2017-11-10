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

Route::view('/', 'pages.home');
Route::view('/about', 'pages.about');
Route::view('/contact', 'pages.contact');

Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::post('/logout','Auth\LoginController@logout')->name('logout');


Route::resource('posts', 'PostController');
Route::resource('categories', 'CategoryController', ['except' => 'create']);
Route::resource('tags', 'TagController', ['except' => 'create']);
