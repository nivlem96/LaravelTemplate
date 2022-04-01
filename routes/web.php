<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\PublicController;
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

Route::get('/', [PublicController::class, 'home']);

Route::post('/locale', function () {
    session(['app.locale' => app('request')->input('locale', 'en')]);

    return redirect()->back();
});

Route::get('/login', [PublicController::class, 'login']);
Route::post('/login', [AuthenticateController::class, 'login']);
Route::get('/register', [PublicController::class, 'register']);
Route::post('/register', [AuthenticateController::class, 'register']);

Route::get('/dashboard', [AuthenticatedController::class, 'dashboard']);
Route::get('/signOut', [AuthenticatedController::class, 'signOut']);
