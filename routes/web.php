<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\products\BrandController;
use \App\Http\Controllers\products\CategoryController;
use \App\Http\Controllers\products\ProductController;

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

Route::prefix('/cadastros')->group(function () {
    Route::prefix('/produtos')->group(function () {
        Route::resource('marcas', BrandController::class);
        Route::resource('categorias', CategoryController::class);
        Route::resource('itens', ProductController::class);
    });
    
});

