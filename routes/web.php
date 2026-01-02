<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/transaction', [TransactionController::class, 'index'])->middleware(['auth', 'verified'])->name('transaction');
Route::post('/transaction', [TransactionController::class, 'store'])
    ->name('transactions.store');
Route::get('/report', [ReportController::class, 'index'])->middleware(['auth', 'verified'])->name('report');
Route::post('/item/store', [ItemController::class, 'store'])->middleware(['auth', 'verified'])->name('item.store');
Route::post('/items/check-code', [ItemController::class, 'checkCode'])->name('item.check-code');
// routes/web.php
Route::resource('item', ItemController::class);
Route::get('/item', [ItemController::class, 'index'])->middleware(['auth', 'verified'])->name('item');
Route::get('/item/create', [ItemController::class, 'create'])->middleware(['auth', 'verified'])->name('item.create');

Route::post('/item', [ItemController::class, 'store'])->middleware(['auth', 'verified'])->name('item.store');
Route::get('/item/{item}/edit', [ItemController::class, 'edit'])->middleware(['auth', 'verified'])->name('item.edit');
Route::put('/item/{item}', [ItemController::class, 'update'])->middleware(['auth', 'verified'])->name('item.update');
Route::delete('/item/{item}', [ItemController::class, 'destroy'])->middleware(['auth', 'verified'])->name('item.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
