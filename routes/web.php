<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController; // Ini nanti kita buat

Route::get('/', function () {
    return view('welcome');
});

// Route yang hanya bisa diakses kalau sudah login
Route::middleware(['auth'])->group(function () {
    
    // Resource route untuk CRUD barang
    Route::resource('items', ItemController::class);

    // Route untuk transaksi (Masuk/Keluar/Kembali)
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});