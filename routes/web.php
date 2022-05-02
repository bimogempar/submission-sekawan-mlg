<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\VehicleController;
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
    // USER
    Route::middleware('user')->group(function () {
        Route::get('/user/dashboard', [DashboardController::class, 'indexUser'])->name('indexUser');
    });

    // ADMIN
    Route::middleware('admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'indexAdmin'])->name('indexAdmin');

        // Store
        Route::post('/admin/create/request-rent', [RentController::class, 'storeRent'])->name('storeRent');
        Route::post('/admin/create/new-vehicle', [VehicleController::class, 'storeVehicle'])->name('storeVehicle');

        // Update
        Route::patch('/admin/update/vehicle/{id}', [VehicleController::class, 'updateVehicle'])->name('updateVehicle');

        // Modal
        Route::get('/admin/create/request-rent', [RentController::class, 'modalCreateRent'])->name('modalCreateRent');
        Route::get('/admin/create/vehicle', [VehicleController::class, 'modalCreateVehicle'])->name('modalCreateVehicle');
        Route::get('/admin/edit/vehicle/{id}', [VehicleController::class, 'modalEditVehicle'])->name('modalEditVehicle');
    });

    // APPROVAL
    Route::middleware('approval')->group(function () {
        Route::get('/approval/dashboard', [DashboardController::class, 'indexApproval'])->name('indexApproval');

        // Approval
        Route::patch('/approval/rent/{id}', [RentController::class, 'approvalRent'])->name('approvalRent');
    });

    // RELOAD COMPONENTS
    Route::get('/admin/reload/rent', [RentController::class, 'reloadRent'])->name('reloadRent');
    Route::get('/admin/reload/vehicle', [VehicleController::class, 'reloadVehicle'])->name('reloadVehicle');
});
