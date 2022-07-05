<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PublicController::class, 'home'])->name('home');

Route::post('/locale', function () {
    session(['app.locale' => app('request')->input('locale', config('app.locale'))]);

    return redirect()->back();
})->name('localePost');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/forgot-password', [PublicController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthenticateController::class, 'forgotPassword'])->name('password.request.post');
    Route::get('/reset-password/{token}', [PublicController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthenticateController::class, 'resetPassword'])->name('password.reset.post');
    Route::get('/login', [PublicController::class, 'login'])->name('login');
    Route::post('/login', [AuthenticateController::class, 'login'])->name('loginPost');
    Route::get('/register', [PublicController::class, 'register'])->name('register');
    Route::post('/register', [AuthenticateController::class, 'register'])->name('registerPost');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [AuthenticatedController::class, 'dashboard'])->name('dashboard');
    Route::get('/signOut', [AuthenticatedController::class, 'signOut'])->name('signOut');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/admin/logs', [AdminController::class, 'logs'])->name('logs');
    Route::get('/admin/logs/{id}', [AdminController::class, 'log'])->name('log');

    Route::get('/delete-user/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');
});
