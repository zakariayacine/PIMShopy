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
    return Auth::id(); 
    //return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    //home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //images
    Route::post('/imageDestroy', [App\Http\Controllers\ImageController::class, 'destroy'])->name('image.delete');
    //Route::post('/imageUpload', [App\Http\Controllers\ImageController::class, 'store'])->name('ImageUpload');
    Route::get('/images', [App\Http\Controllers\ImageController::class, 'index'])->name('images');
    Route::get('/images/create', [App\Http\Controllers\ImageController::class, 'create'])->name('images.import');
    //Csv
    Route::get('/products', [App\Http\Controllers\ShopifyCsvController::class, 'index'])->name('products');
    Route::get('/import', [App\Http\Controllers\ShopifyCsvController::class, 'import'])->name('import');
    Route::get('/edit/{id}', [App\Http\Controllers\ShopifyCsvController::class, 'edit'])->name('edit');
    Route::post('/upload/file/excel',  [App\Http\Controllers\ShopifyCsvController::class, 'upload'])->name('upload');
    Route::get('/export/file/excel',  [App\Http\Controllers\ShopifyCsvController::class, 'export'])->name('export');
    Route::post('/csvs/image',  [App\Http\Controllers\ShopifyCsvController::class, 'imageUpdate'])->name('image.update');
    Route::get('/csv/{id}',  [App\Http\Controllers\ShopifyCsvController::class, 'show'])->name('csv.show');
    //Settings
    Route::get('/settings',  [App\Http\Controllers\SettingController::class, 'index'])->name('settings');
    Route::post('/userinfos',  [App\Http\Controllers\SettingController::class, 'utilisateur'])->name('utilisateur.update');
    Route::post('/tinypng',  [App\Http\Controllers\SettingController::class, 'tinypng'])->name('api.tinypng');
    Route::get('/testimage',  [App\Http\Controllers\CounterController::class, 'show'])->name('test.show');
});
