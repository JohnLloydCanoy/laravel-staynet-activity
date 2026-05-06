<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Existing Controllers
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Activity 13 Controllers
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanTransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // 1. PROFILE - Everyone logged in can access
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 2. ADMIN ONLY - Only users with the 'admin' role
    // If you don't have a custom middleware yet, you can wrap them in a group 
    // or check the role in the controller. For the script logic, we show them grouped:
    Route::middleware(['can:admin-only'])->group(function () {
        Route::get('/customers/export-pdf', [CustomerController::class, 'exportPDF'])->name('customers.pdf');
        Route::resource('customers', CustomerController::class);
        Route::resource('loantransactions', LoanTransactionController::class);
        Route::get('/loantransactions/pdf', [LoanTransactionController::class, 'generatePDF'])->name('loantransactions.pdf');
    });

    // 3. STAFF & ADMIN - Users who can manage products/loans
    Route::middleware(['can:staff-access'])->group(function () {
        Route::resource('loans', LoanController::class);
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    });

    // 4. GENERAL - Orders view for everyone
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

require __DIR__.'/auth.php';