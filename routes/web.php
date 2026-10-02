<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\DashboardController;


Route::resource('authors', AuthorController::class);
Route::resource('books', BookController::class);
Route::resource('categories', CategoryController::class);
Route::resource('loans', LoanController::class)->except(['edit', 'update']);
Route::post('/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
