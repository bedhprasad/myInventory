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

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/register', 'App\Http\Controllers\AuthController@register')->name('register');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/dashboard', 'App\Http\Controllers\DashboardController@dashboard');
Route::resource('/product', 'App\Http\Controllers\ProductController');
Route::resource('/product-category', 'App\Http\Controllers\ProductCategoryController');
Route::resource('/user', 'App\Http\Controllers\UserController');

Route::get('/logout', 'App\Http\Controllers\AuthController@logout');
