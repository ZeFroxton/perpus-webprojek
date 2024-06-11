<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanApprovalController;

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


// Route::get('/dashboard', function () {
//     return view('admin.dashboard_admin');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route untuk Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    //view buku table dan create untuk admin
    Route::get('/admin/book', [BookController::class, 'indexAdmin'])->name('buku.admin');
    Route::post('/admin/buku', [BookController::class, 'storeAdmin'])->name('admin.store-buku');
    Route::get('admin/book/create-admin', [BookController::class, 'createAdmin'])->name('admin.create');
    //view edit buku dan update buku
    Route::get('admin/buku/edit-admin/{id}', [BookController::class, 'editAdmin'])->name('admin.buku-edit');
    Route::put('admin/buku/edit-admin/{id}', [BookController::class, 'updateAdmin'])->name('admin.buku-update');

    Route::delete('/buku{id}', [BookController::class, 'destroyAdmin'])->name('admin.buku-destroy');

    Route::get('/admin/table-petugas', [PetugasController::class, 'tablePetugas'])->name('admin.table');
    Route::get('/admin/create-petugas', [PetugasController::class, 'showCreatePetugasForm'])->name('admin.create-petugas');
    Route::post('/admin/create-petugas', [PetugasController::class, 'createPetugas'])->name('admin.store-petugas');
    Route::get('/admin/category', [CategoryController::class, 'indexAdmin'])->name('category.admin');
    Route::post('/category/create', [CategoryController::class, 'storeAdmin'])->name('category.store');
    Route::put('/category/edit-petugas/{id}', [CategoryController::class, 'updateAdmin'])->name('admin.category-update');

    Route::delete('/category{id}', [CategoryController::class, 'destroyAdmin'])->name('admin.category-destroy');
    // Tambahkan route lainnya untuk admin
});
//Route untuk user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/home', [UserController::class, 'index'])->name('user.index');
    Route::get('/home/{id}', [UserController::class, 'show'])->name('show.buku');
    Route::post('/loan/request', [LoanController::class, 'requestLoan'])->name('loan.request');
    //profile user

    Route::get('/loans', [UserController::class, 'loanindex'])->name('user.loans');
    Route::patch('/loans/{loan}/return', [UserController::class, 'returnBook'])->name('return.book');
});
//Route untuk petugas
Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
    //create category
    Route::get('/category', [CategoryController::class, 'indexPetugas'])->name('category.index');
    Route::post('/category/create-petugas', [CategoryController::class, 'storePetugas'])->name('petugas.category-store');
    Route::put('/category/edit-petugas/{id}', [CategoryController::class, 'updatePetugas'])->name('petugas.category-update');
    Route::delete('/category{id}', [CategoryController::class, 'destroyPetugas'])->name('petugas.category-destroy');
    //create buku
    Route::get('/buku', [BookController::class, 'indexPetugas'])->name('buku.index');
    Route::post('/buku', [BookController::class, 'storePetugas'])->name('buku.store');
    Route::get('/buku/create', [BookController::class, 'createPetugas'])->name('buku.create');
    Route::get('/buku/edit-petugas/{id}', [BookController::class, 'editPetugas'])->name('petugas.buku-edit');
    Route::put('/buku/edit-petugas/{id}', [BookController::class, 'updatePetugas'])->name('petugas.buku-update');

    Route::delete('/buku{id}', [BookController::class, 'destroyAdmin'])->name('admin.buku-destroy');
    //loan aproval
    Route::get('/admin/loan-requests', [LoanApprovalController::class, 'index'])->name('admin.loan.requests');
    Route::post('/admin/loan-approve/{loan}', [LoanApprovalController::class, 'approve'])->name('admin.loan.approve');
    Route::post('/admin/loan-reject/{loan}', [LoanApprovalController::class, 'reject'])->name('admin.loan.reject');

});




//untuk membuat,mengupdate,mendelete buku







Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__.'/auth.php';
