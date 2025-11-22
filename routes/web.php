<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BookingAdminController;
use App\Http\Controllers\BookingManageController;
use App\Http\Controllers\FinanceReportController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Halaman login & register
// Halaman login & register (tidak boleh diakses jika sudah login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});



/*
|--------------------------------------------------------------------------
| Protected Routes (User & Admin)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | User Routes (Customer / Penyewa)
    |--------------------------------------------------------------------------
    */
    Route::get('/', function () {
        return view('dashboard'); // Dashboard user
    })->name('dashboard');



    // Booking
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');

    // schedule
    Route::get('/schedules', [BookingController::class, 'allSchedules'])->middleware('auth');


    // Payment
    Route::get('/payment/{booking_id}', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/{booking_id}', [PaymentController::class, 'store'])->name('payment.store');

    // Receipt
    Route::get('/payment/receipt/{payment}', [PaymentController::class, 'receipt'])->name('payment.receipt');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    // Route::middleware('admin')->group(function () {

    //     // Branches
    //     Route::resource('branches', BranchController::class);

    //     // Items (PS, kamera, alat)
    //     Route::resource('items', ItemController::class);

    //     // Semua booking (admin)
    //     Route::get('/admin/bookings', [BookingController::class, 'adminIndex'])
    //          ->name('admin.bookings');

    //     // Finance Report
    //     Route::get('/finance-reports', [FinanceReportController::class, 'index'])
    //          ->name('finance.index');

    //     Route::post('/finance-reports/generate', [FinanceReportController::class, 'generate'])
    //          ->name('finance.generate');
    // });

});

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::resource('items', ItemController::class);
// });

Route::middleware(['auth', 'admin'])->group(function () {

    // Items Index (List)
    Route::get('/items', [ItemController::class, 'index'])->name('items.index');

    // Create Form
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');

    // Store Data
    Route::post('/items', [ItemController::class, 'store'])->name('items.store');

    // Edit Form
    Route::get('/items/{item}/edit', [ItemController::class, 'edit'])->name('items.edit');

    // Update Data
    Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');

    // Delete Data
    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
});
