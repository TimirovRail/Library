<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

    // Librarian routes
    Route::get('/librarian', [LibrarianController::class, 'index'])->name('librarian.dashboard');
    Route::get('/librarian/books', [LibrarianController::class, 'index'])->name('librarian.books.index');
    Route::get('/librarian/books/create', [LibrarianController::class, 'create'])->name('librarian.books.create');
    Route::post('/librarian/books', [LibrarianController::class, 'store'])->name('librarian.books.store');
    Route::get('/librarian/books/{book}/edit', [LibrarianController::class, 'edit'])->name('librarian.books.edit');
    Route::put('/librarian/books/{book}', [LibrarianController::class, 'update'])->name('librarian.books.update');
    Route::delete('/librarian/books/{book}', [LibrarianController::class, 'destroy'])->name('librarian.books.destroy');
    Route::post('librarian/books/loan', [LibrarianController::class, 'loanBook'])->name('librarian.books.loan');
    Route::post('librarian/books/return/{loan}', [LibrarianController::class, 'returnBook'])->name('librarian.books.return');
    Route::get('librarian/books/loans', [LibrarianController::class, 'loans'])->name('librarian.books.loans');

    // Client routes
    Route::get('/client', [ClientController::class, 'index'])->name('client.dashboard');
    Route::get('client/books', [ClientController::class, 'index'])->name('client.books.index');
    Route::post('client/books/reserve/{book}', [ClientController::class, 'reserveBook'])->name('client.books.reserve');
    Route::post('client/books/cancel/{book}', [ClientController::class, 'cancelReservation'])->name('client.books.cancel');
    Route::post('client/books/rate/{book}', [ClientController::class, 'rateBook'])->name('client.books.rate');
    Route::post('client/books/comment/{book}', [ClientController::class, 'commentBook'])->name('client.books.comment');
    Route::post('client/books/review/{book}', [ClientController::class, 'addReview'])->name('client.books.addReview');

});