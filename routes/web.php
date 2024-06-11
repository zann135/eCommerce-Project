<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\TengkulakController;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Auth Route
Route::get('/', [AuthController::class, 'index'])->name('index');
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::get('login_form', [AuthController::class, 'login_form'])->name('login_form');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');


// Tengkulak Route
Route::get('dashboard_tengkulak', [TengkulakController::class, 'dashboard'])->name('dashboard_tengkulak');
Route::get('list_lelang', [TengkulakController::class, 'list_lelang'])->name('list_lelang');
Route::get('history_lelang_tengkulak', [TengkulakController::class, 'history_lelang_view'])->name('history_lelang_tengkulak');

Route::get('join_lelang', [AuthController::class, 'join_lelang'])->name('join_lelang');

// end test route

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['login_check:user']], function () {
        Route::resource('1', TengkulakController::class);
    });
    Route::group(['middleware' => ['login_check:user']], function () {
        Route::resource('2', CustomerController::class);
    });
});
