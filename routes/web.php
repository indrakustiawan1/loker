<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('authenticate', [LoginController::class, 'authenticate']);

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => ['role:superadmin']], function () {
        //user
        Route::post('user/datatables_user', [UserController::class, 'datatables_user'])->name('user-list');
        Route::get('user', [UserController::class, 'index'])->name('user');
        Route::post('user', [UserController::class, 'store']);
        Route::get('user/{user}/edit', [UserController::class, 'edit']);
        Route::delete('user/{user}', [UserController::class, 'destroy']);
    });
});
