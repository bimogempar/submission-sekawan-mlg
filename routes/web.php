<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RentController;
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
    return redirect()->route('loginPage');
});

// Auth
Route::get('/login', [AuthController::class, 'loginPage'])->name('loginPage');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // User
    Route::middleware('user')->group(function () {
        Route::get('/user/dashboard', [DashboardController::class, 'indexUser'])->name('indexUser');
    });

    // Admin
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'indexAdmin'])->name('indexAdmin');
        Route::post('/user/create/request-rent', [RentController::class, 'storeRent'])->name('storeRent');
    });

    // Penyetuju
    Route::middleware('approval')->group(function () {
        Route::get('/approval/dashboard', [DashboardController::class, 'indexApproval'])->name('indexApproval');
    });
});
