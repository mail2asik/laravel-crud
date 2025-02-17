<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', [ContactController::class, 'index'])->name('contacts.index');

Route::name('contacts.')->group(function () {
    Route::get('/create', [ContactController::class, 'create'])->name('create');
    Route::post('/store', [ContactController::class, 'store'])->name('store');

    Route::get('/show/{id}', [ContactController::class, 'show'])->name('show');

    Route::get('/edit/{id}', [ContactController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [ContactController::class, 'update'])->name('update');

    Route::get('/delete', [ContactController::class, 'create'])->name('destroy');
});