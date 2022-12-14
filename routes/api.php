<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/images/get', [App\Http\Controllers\ImageController::class, 'getSyncImage'])->name('images.api.get');
Route::post('/image', [App\Http\Controllers\ImageController::class, 'updateImage'])->name('images.api.post');
Route::get('/show/{code}', [App\Http\Controllers\ImageController::class, 'show'])->name('show');
Route::post('/create', [App\Http\Controllers\CounterController::class, 'create'])->name('image.create');
