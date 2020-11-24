<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\VideoController;



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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('category', CategoryController::class);
Route::resource('resep', ResepController::class);
Route::resource('video', VideoController::class);

Route::post('delete-category', [CategoryController::class,'destroy']);
Route::post('delete-resep', [ResepController::class,'destroy']);
Route::post('delete-video', [VideoController::class,'destroy']);

Route::any('/getCategory', [App\Http\Controllers\ResepController::class, 'getCategory'])->name('resep');
Route::any('/getCategory_video', [App\Http\Controllers\VideoController::class, 'getCategory'])->name('video');