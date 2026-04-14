<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RiceController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'rices' => \App\Models\Rice::all(),
        'orders' => \App\Models\Order::with('rice')->latest()->get(),
        'payments' => \App\Models\Payment::with('order.rice')->latest()->get()
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {

    Route::resource('rices',RiceController::class);
    Route::resource('orders',OrderController::class);
    Route::post('/orders/add', [OrderController::class, 'add'])->name('orders.add');

    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::post('/payments/{order}', [PaymentController::class,'store'])->name('payments.store');
});



