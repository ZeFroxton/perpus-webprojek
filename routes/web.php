<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard_admin');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/buku', [BookController::class, 'index'])->name('buku.index');
Route::get('/buku/create', [BookController::class, 'create'])->name('buku.create');
Route::get('/buku/edit{id}', [BookController::class, 'edit'])->name('buku.edit');

Route::post('/buku', [BookController::class, 'store'])->name('buku.store');
Route::put('/buku{id}', [BookController::class, 'update'])->name('buku.update');
Route::delete('/buku{id}', [BookController::class, 'destroy'])->name('buku.destroy');

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/create', [CategoryController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
