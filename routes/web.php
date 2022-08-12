<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
Route::get('/imageUpload/{id}', [App\Http\Controllers\ImageUploadController::class, 'upload'])->name('ImageUpload');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/import', [App\Http\Controllers\ShopifyCsvController::class, 'import'])->name('import');
Route::get('/edit/{id}', [App\Http\Controllers\ShopifyCsvController::class, 'edit'])->name('edit');
Route::post('/upload/file/excel',  [App\Http\Controllers\ShopifyCsvController::class, 'upload'])->name('upload');