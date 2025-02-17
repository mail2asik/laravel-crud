<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', [ContactController::class, 'index'])->name('contacts.index');

Route::name('contacts.')->group(function () {
    Route::get('/create', [ContactController::class, 'create'])->name('create');
    Route::post('/store', [ContactController::class, 'store'])->name('store');

    Route::get('/show/{uid}', [ContactController::class, 'show'])->name('show');

    Route::get('/edit/{uid}', [ContactController::class, 'edit'])->name('edit');
    Route::put('/update/{uid}', [ContactController::class, 'update'])->name('update');

    Route::get('/delete/{uid}', [ContactController::class, 'destroy'])->name('destroy');
});