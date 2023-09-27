<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RumahController;
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

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('loginPost');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['admin'])->group(function () {

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/index', [MainController::class, 'index'])->name('beranda');

        Route::resource('rumah', RumahController::class);
    });

});
