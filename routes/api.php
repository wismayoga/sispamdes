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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login'])->name('login');
Route::post('/loginPelanggan', [App\Http\Controllers\Api\AuthPelangganController::class, 'login'])->name('loginPelanggan');
Route::get('/login', [App\Http\Controllers\Api\AuthController::class, 'getUser'])->name('getUser');
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->name('logout')->middleware(['auth:sanctum']);


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/pendataans', App\Http\Controllers\Api\PendataanController::class);
    Route::put('/pendataans/status/{id}', [App\Http\Controllers\Api\PendataanController::class, 'status'])->name('status');
    
    Route::get('/harga', [App\Http\Controllers\Api\PendataanController::class, 'getHarga'])->name('harga.index');
    Route::get('/pendataanById', [App\Http\Controllers\Api\PendataanController::class, 'getPendataanById'])->name('pendataanById');

    Route::apiResource('/users', App\Http\Controllers\Api\UserController::class);
    Route::post('/userUpdate/{id}', [App\Http\Controllers\Api\UserController::class, 'updatePelanggan'])->name('userUpdate');
    Route::apiResource('/profile', App\Http\Controllers\Api\ProfileController::class);
    Route::apiResource('/krisar', App\Http\Controllers\Api\KrisarController::class);
    Route::post('/change-password/{id}', [App\Http\Controllers\Api\ProfileController::class, 'updatePassword'])->name('update-password');
    Route::post('/profile-foto/{id}', [App\Http\Controllers\Api\ProfileController::class, 'updateFoto'])->name('update-foto');
});
