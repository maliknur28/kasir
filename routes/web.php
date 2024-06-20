<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TransactionDetailController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['guest'])->group(function () {
    // route login
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.proces');
});

Route::middleware(['auth'])->group(function () {
    // routes profile
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profil/{id}', [ProfileController::class, 'update'])->name('profile.update');

    // route logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    // route home
    Route::get('/beranda', [HomeController::class, 'index'])->name('home');

    // routes register
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::put('/register/{id}', [RegisterController::class, 'update'])->name('register.update');
    Route::delete('/register/{id}', [RegisterController::class, 'destroy'])->name('register.destroy');

    // routes product
    Route::get('/produk', [ProductController::class, 'index'])->name('product');
    Route::post('/produk', [ProductController::class, 'store'])->name('product.store');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    // routes discount
    Route::get('/diskon', [DiscountController::class, 'index'])->name('discount');
    Route::put('/diskon/{id}', [DiscountController::class, 'update'])->name('discount.update');
});

Route::middleware(['auth', 'role:Petugas'])->group(function () {
    // routes transaction
    Route::get('/transaksi', [TransactionController::class, 'create'])->name('transaction');
    Route::post('/get-produk', [TransactionDetailController::class, 'getProduct'])->name('get.product');
    Route::post('/detail-transaksi', [TransactionDetailController::class, 'store'])->name('transactionDetail.store');
    Route::delete('/detail-transaksi/{id}', [TransactionDetailController::class, 'destroy'])->name('transactionDetail.destroy');
    Route::post('/get-diskon', [TransactionController::class, 'getDiscount'])->name('get.discount');
    Route::post('/transaksi', [TransactionController::class, 'store'])->name('transaction.store');

    // routes member
    Route::get('/anggota', [MemberController::class, 'index'])->name('member');
    Route::post('/anggota', [MemberController::class, 'store'])->name('member.store');
    Route::put('/anggota/{id}', [MemberController::class, 'update'])->name('member.update');
    Route::delete('/anggota/{id}', [MemberController::class, 'destroy'])->name('member.destroy');

    // routes report
    Route::get('/laporan/transaksi', [ReportController::class, 'transaction'])->name('report.transaction');
    Route::get('/laporan/stok', [ReportController::class, 'stock'])->name('report.stock');
    Route::post('/filter-transaksi', [TransactionController::class, 'filterTransaction'])->name('filter.transaction');
    Route::post('/filter-stok', [TransactionController::class, 'filterStock'])->name('filter.stock');
});
