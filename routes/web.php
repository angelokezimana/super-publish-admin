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

// Login Page
Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes(['register' => false, 'reset' => false, 'confirm' => false]);

Route::get('/home', 'HomeController@index')->name('home');

//CRUD for categories
Route::resource('categories', 'CategoriesController');
Route::post('categories/destroy/{categorie}', 'CategoriesController@destroy');

Route::get('/profile', 'UserController@profile')->name('users.profile');

//users
Route::get('/users', 'UserController@index')->name('users.index');
Route::post('/users', 'UserController@store')->name('users.store');
Route::put('/users/{user}', 'UserController@update')->name('users.update');
Route::put('users/{user}/suspend', 'UserController@suspend')->name('users.suspend');
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');

//roles
Route::get('/roles', 'RoleController@index')->name('roles.index');
Route::post('/roles', 'RoleController@store')->name('roles.store');
Route::put('/roles/{role}', 'RoleController@update')->name('roles.update');
Route::delete('/roles/{role}', 'RoleController@destroy')->name('roles.destroy');

//deleted user
Route::get('/users_suppr', 'RecyclebinController@index_users')->name('recycleBin.users');
Route::post('users/restore/{user}', 'RecyclebinController@restore_users');

//deleted categories
Route::get('/categories_suppr', 'RecyclebinController@index_categories');
Route::post('categories/restore/{categorie}', 'RecyclebinController@restore_categories');

// Reports
Route::get('reports', 'ReportController@index')->name('reports.index');
Route::match(['get', 'post'], 'reports/search', 'ReportController@search')->name('reports.search');

// CRUD for publications
Route::post('check-publications', 'PublicationController@checkPublicationValidation');
Route::post('upload_image', 'PublicationController@uploadImage')->name('upload');
Route::resource('publications', 'PublicationController');

//pages
Route::post('pages/upload_image', 'PageController@uploadImage')->name('pages.upload');
Route::resource('pages', 'PageController');
