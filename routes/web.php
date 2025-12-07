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
use App\Http\Controllers\DashboardController;
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
    // Route::get('/', function () {
    //     return view('dashboard'); // Dashboard user
    // })->name('dashboard');

    
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('auth');


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

    // payment admin
    Route::post('/admin/bookings/{id}/pay', [BookingController::class, 'pay'])
    ->name('admin.bookings.pay');



    // Receipt
    Route::get('/payment/receipt/{payment}', [PaymentController::class, 'receipt'])->name('payment.receipt');

});



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


    // CETAK LAPORAN
    Route::get('/admin/laporan', [ReportController::class, 'index'])
        ->name('laporan.index');

    Route::post('/admin/laporan/harian', [ReportController::class, 'harian'])
        ->name('laporan.harian');

    Route::post('/admin/laporan/mingguan', [ReportController::class, 'mingguan'])
        ->name('laporan.mingguan');

    Route::post('/admin/laporan/bulanan', [ReportController::class, 'bulanan'])
        ->name('laporan.bulanan');

    Route::get('/admin/laporan/cetak/{jenis}', [ReportController::class, 'cetak'])
        ->name('laporan.cetak');
    

});

Route::middleware('admin')->group(function () {

    // === BRANCH MANAGEMENT ===
    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
    Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
    Route::post('/branches/store', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/branches/edit/{id}', [BranchController::class, 'edit'])->name('branches.edit');
    Route::post('/branches/update/{id}', [BranchController::class, 'update'])->name('branches.update');
    Route::delete('/branches/delete/{id}', [BranchController::class, 'destroy'])->name('branches.delete');

});

Route::middleware('admin')->group(function () {

    // Kelola Booking Admin
    Route::get('/admin/bookings', [BookingController::class, 'adminIndex2'])->name('admin.bookings');
    Route::post('/admin/bookings/{id}/accept', [BookingController::class, 'accept'])->name('admin.bookings.accept');
    Route::post('/admin/bookings/{id}/reject', [BookingController::class, 'reject'])->name('admin.bookings.reject');
    Route::post('/admin/bookings/{id}/ongoing', [BookingController::class, 'ongoing'])->name('admin.bookings.ongoing');
    Route::post('/admin/bookings/{id}/done', [BookingController::class, 'done'])->name('admin.bookings.done');

});

