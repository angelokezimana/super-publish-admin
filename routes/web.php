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

Route::get('/', function () {
    return view('templates.default');
});

Auth::routes(['register' => false, 'reset' => false, 'confirm' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin_dashboard', 'Admin\DashboardController@index')->middleware('role:admin');
Route::get('/editor_dashboard', 'Editor\DashboardController@index')->middleware('role:editor');

//CRUD for categories
Route::get('categories', 'CategoriesController@index');
Route::get('categories/create', 'CategoriesController@create');
Route::post('categories', 'CategoriesController@store');
