<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\OrderManagementController;
use App\Http\Controllers\Auth\RoleLoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SalesReportController;
use App\Http\Controllers\Employee\ReservationController;
use App\Http\Controllers\Customer\ReservationController as CustomerReservationController;
use App\Http\Controllers\Customer\ReviewController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing');
})->name('landing');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/choose-role', [RoleLoginController::class, 'chooseRole'])->name('choose.role');
Route::get('/login/{role}', [RoleLoginController::class, 'loginForm'])->name('login.role');
Route::post('/login/{role}', [RoleLoginController::class, 'processLogin'])->name('login.process');
Route::post('/logout', [RoleLoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Customer Menu Page
|--------------------------------------------------------------------------
*/
Route::get('/menu', fn() => view('customer.menu'))->name('menu');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

        Route::resource('categories', CategoryController::class);
        Route::resource('menus', MenuController::class);

        Route::get('/reports/sales', [SalesReportController::class, 'index'])
            ->name('reports.sales');
    });

/*
|--------------------------------------------------------------------------
| Employee Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:employee'])
    ->prefix('employee')
    ->name('employee.')
    ->group(function () {

        Route::get('/dashboard', fn() => view('employee.dashboard'))->name('dashboard');

        // Reservations CRUD
        Route::resource('reservations', ReservationController::class);

        // 🔥 UBAH MENJADI POST
        Route::post('/reservations/{reservation}/status', 
            [ReservationController::class, 'updateStatus'])
            ->name('reservations.updateStatus');

        Route::post('/reservations/{reservation}/complete', 
            [ReservationController::class, 'complete'])
            ->name('reservations.complete');

        // Orders
        Route::resource('orders', OrderManagementController::class)->only(['index', 'show']);

        // 🔥 UBAH MENJADI POST
        Route::post('/orders/{order}/status', 
            [OrderManagementController::class, 'updateStatus'])
            ->name('orders.updateStatus');
    });

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:customer'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        Route::get('/dashboard', fn() => view('customer.dashboard'))->name('dashboard');

        Route::resource('reservations', CustomerReservationController::class)
            ->only(['index', 'create', 'store', 'show']);

        Route::get('/reservations/{reservation}/review', [ReviewController::class, 'create'])
            ->name('reservations.review');

        Route::post('/reservations/{reservation}/review', [ReviewController::class, 'store'])
            ->name('reviews.store');
    });
