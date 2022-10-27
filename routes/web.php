<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
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

Route::controller(AuthController::class)->name('admin.')->prefix('admin')->group(function () {
    Route::get('login', 'loginPage')->name('loginPage');
    Route::post('login', 'login')->name('login');
    Route::get('logout','logout')->name('logout');
});

Route::name('admin.')->prefix('admin')->middleware('auth')->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('brands', BrandController::class);
});

