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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\ProductController::class, 'showList'])->name('home');
Route::get('/product_new', [App\Http\Controllers\ProductController::class, 'productNew'])->name('product_new');
Route::post('/product_new', [App\Http\Controllers\ProductController::class, 'registSubmit'])->name('submit');
Route::get('/product_detail/{id}', [App\Http\Controllers\ProductController::class, 'productDetail'])->name('product_detail');
Route::get('/product_edit/{id}', [App\Http\Controllers\ProductController::class, 'productEdit'])->name('product_edit');
Route::post('/product_update/{id}', [App\Http\Controllers\ProductController::class, 'productUpdate'])->name('product_update');
