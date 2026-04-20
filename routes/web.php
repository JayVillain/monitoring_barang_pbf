<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;

// 1. Route PUBLIC (Bisa diakses tanpa login)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// 2. Route PRIVATE (Harus login dulu)
Route::middleware(['auth'])->group(function () {
    
    // Redirect halaman utama ke daftar barang
    Route::get('/', function () {
        return redirect()->route('items.index');
    });

    // Resource route untuk CRUD barang
    Route::resource('items', ItemController::class);

    // Route untuk transaksi (Masuk/Keluar/Kembali)
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');
    
    // Logout harus di dalam auth karena hanya yang login yang bisa logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});