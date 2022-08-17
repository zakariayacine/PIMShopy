<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::middleware(['auth'])->group(function () {
    Route::post('/imageDestroy', [App\Http\Controllers\ImageController::class, 'destroy'])->name('image.delete');
    Route::post('/imageUpload', [App\Http\Controllers\ImageController::class, 'store'])->name('ImageUpload');
    Route::get('/images', [App\Http\Controllers\ImageController::class, 'index'])->name('images');
    Route::get('/images/create', [App\Http\Controllers\ImageController::class, 'create'])->name('images.import');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/import', [App\Http\Controllers\ShopifyCsvController::class, 'import'])->name('import');
    Route::get('/edit/{id}', [App\Http\Controllers\ShopifyCsvController::class, 'edit'])->name('edit');
    Route::post('/upload/file/excel',  [App\Http\Controllers\ShopifyCsvController::class, 'upload'])->name('upload');
});
