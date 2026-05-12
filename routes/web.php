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

    // =========================================================
    // ACTIVITY 15: FUNCTIONALITY RBAC
    // Everyone can access the Customers routes. The Controller 
    // now decides who can Add, Edit, or Delete based on role!
    // =========================================================
    Route::get('/customers/export-pdf', [CustomerController::class, 'exportPDF'])->name('customers.pdf');
    Route::resource('customers', CustomerController::class);

    // 2. ADMIN ONLY 
    Route::middleware(['can:admin-only'])->group(function () {
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