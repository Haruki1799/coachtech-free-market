<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Auth;


use App\Models\Address;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/login', [UserController::class, 'login'])->name('home');
Route::post('/register', [UserController::class, 'register']);
Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
Route::get('/mypage/profile', [AddressController::class, 'edit'])->name('mypage_profile.edit');
Route::post('/mypage/profile', [AddressController::class, 'store'])->name('mypage_profile');

Route::get('/mypage/profile', [UserController::class, 'mypage_profile'])->name('mypage_profile');
Route::get('/mypage/profile', [AddressController::class, 'edit'])->name('mypage.profile.edit');
Route::get('/purchase/address/{item_id}', [AddressController::class, 'editForItem'])->name('address.edit.item');
Route::post('/purchase/address/{item_id}', [AddressController::class, 'updateForItem'])->name('address.update.item');

Route::get('/mypage/profile/edit', [AddressController::class, 'edit'])->name('address.edit.profile');
Route::post('/mypage/profile/edit', [AddressController::class, 'store'])->name('address.update.profile');


Route::get('/sell', [ProductController::class, 'create'])->name('sell');

Route::get('/', [GoodsController::class, 'index'])->name('home');
Route::get('/item', [GoodsController::class, 'index']);
Route::get('/item/{id}', [GoodsController::class, 'show'])->name('goods.show');
Route::post('/item', [GoodsController::class, 'store'])->name('goods.store');

Route::middleware('auth')->group(function () {
    Route::get('/purchase/{id}', [PurchaseController::class, 'show'])->name('purchase.show');
    Route::post('/purchase/{item_id}/confirm', [PurchaseController::class, 'confirm'])->name('purchase.confirm');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');