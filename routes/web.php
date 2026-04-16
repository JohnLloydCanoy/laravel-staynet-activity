<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Existing Controllers
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// NEW: Activity 13 Controllers
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanTransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Customer Routes (Activity 12)
    Route::get('/customers/export-pdf', [CustomerController::class, 'exportPDF'])->name('customers.pdf');
    Route::resource('customers', CustomerController::class);
    
    // NEW: Loan & Transaction Routes (Activity 13)
    Route::get('/loantransactions/pdf', [LoanTransactionController::class, 'generatePDF'])->name('loantransactions.pdf');
    Route::resource('loans', LoanController::class);
    Route::resource('loantransactions', LoanTransactionController::class);
    
    // Other Existing Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

require __DIR__.'/auth.php';