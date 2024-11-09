<?php

use App\Http\Controllers\ContractsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConnectionController;
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

Route::get('/', [HomeController::class, 'index'])->middleware('auth');

Route::post('/login', [ConnectionController::class, 'login'])->name('login');

Route::get('/login', function () {
    return view('login');
});

Route::get('/logout', [ConnectionController::class, 'logout'])->name('logout');

Route::post('/register', [ConnectionController::class, 'register'])->name('register');

Route::get('/register', function () {
    return view('register');
});

Route::post('/creationcontrat', [ContractsController::class, 'store'])->middleware('auth')->name('contracts.store');

Route::get('/creationcontrat', function () {
    return view('creationcontrat');
})->middleware('auth')->name('contracts.get');


