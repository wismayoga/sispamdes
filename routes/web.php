<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HargaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PendataanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['middleware' => 'auth', 'cekRoles:Admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['middleware' => 'auth'])->group(function () {
    Route::resource('/profile', \App\Http\Controllers\ProfileController::class);
    Route::get('/change-password/{id}', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password/{id}', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('update-password');
    Route::put('/change-password/{id}', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('update-password');
})->middleware('auth');

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'register_action'])->name('register.action');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login_action'])->name('login.action');
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['middleware' => 'auth', 'cekRoles:Admin'])->prefix('dashboard')->group(function () {
    Route::resource('/harga', \App\Http\Controllers\HargaController::class);
    Route::resource('/users', \App\Http\Controllers\UserController::class);
    Route::resource('/pengaduans', \App\Http\Controllers\PengaduanController::class);
    Route::resource('/pendataans', \App\Http\Controllers\PendataanController::class);
    Route::post('/pendataans/status/{id}', [PendataanController::class, 'status'])->name('status');
    Route::put('/pendataans/status/{id}', [PendataanController::class, 'status'])->name('status');

    Route::get('/qrcode', [QRCodeController::class, 'generateQRCodesPDF'])->name('qrcode');
    Route::get('/qrcode/{id}', [QRCodeController::class, 'generateQRCodesPDFindie'])->name('qrcodeindie');
});