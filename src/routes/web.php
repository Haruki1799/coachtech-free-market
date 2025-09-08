<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\GoodsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\VerificationController;


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

Route::get('/', [GoodsController::class, 'index'])->name('home');
Route::get('/item/{id}', [GoodsController::class, 'show'])->name('goods.show');
Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::post('/goods/{good}/like', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/goods/{good}/like', [LikeController::class, 'destroy'])->name('likes.destroy');
    Route::post('/goods/{good}/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/mypage', [UserController::class, 'mypage'])->name('mypage');
    Route::get('/mypage/profile', [UserController::class, 'mypage_profile'])->name('mypage_profile');

    Route::get('/mypage/profile/edit', [AddressController::class, 'edit'])->name('address.edit.profile');
    Route::post('/mypage/profile/edit', [AddressController::class, 'store'])->name('address.update.profile');

    Route::get('/purchase/address/{item_id}', [AddressController::class, 'editForItem'])->name('address.edit.item');
    Route::post('/purchase/address/{item_id}', [AddressController::class, 'updateForItem'])->name('address.update.item');

    Route::get('/purchase/{id}', [PurchaseController::class, 'show'])->name('purchase.show');
    Route::get('/purchase/{item_id}', [PurchaseController::class, 'confirm'])->name('purchase.confirm');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchase.store');

    Route::get('/sell', [ProductController::class, 'create'])->name('sell');
    Route::post('/sell', [GoodsController::class, 'store'])->name('goods.store');

    Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
});

Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');