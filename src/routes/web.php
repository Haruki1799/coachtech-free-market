<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
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
Route::get('/mypage/profile', [UserController::class, 'mypage'])->name('mypage_profile');
Route::post('/mypage/profile', [AddressController::class, 'store']);


Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('home');
});

