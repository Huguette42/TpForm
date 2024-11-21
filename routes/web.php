<?php

use App\Http\Controllers\ContractsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\SignatureController;
use App\Mail\WelcomMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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


Route::get('/', [HomeController::class, 'index'])->middleware(['auth','verified'])->name('home');

Route::post('/login', [ConnectionController::class, 'login'])->name('login');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/logout', [ConnectionController::class, 'logout'])->name('logout');

Route::post('/register', [ConnectionController::class, 'register'])->name('register');

Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/contract', [ContractsController::class, 'store'])->middleware('auth')->name('contracts.store');

Route::get('/contract', function () {
    return view('contract.creationcontrat');
})->middleware('auth')->name('contracts.get');

Route::get('/editprofil', [ConnectionController::class, 'edituser'])->middleware('auth')->name('user.edit');

Route::put('/editprofil', [ConnectionController::class, 'updateuser'])->middleware('auth')->name('user.update');

Route::put('/updatepassword', [ConnectionController::class, 'updatepassword'])->middleware('auth')->name('user.updatepassword');

Route::get('/contract/{id}', [ContractsController::class, 'show'])->middleware('auth')->name('contracts.show');

Route::get('/contract/{id}/download', [ContractsController::class, 'downloadPDF'])->middleware('auth')->name('contracts.download');

Route::delete('/contract/{id}', [ContractsController::class, 'destroy'])->middleware('auth')->name('contracts.destroy');

Route::get('/contract/{id}/edit', [ContractsController::class, 'edit'])->middleware('auth')->name('contracts.edit');

Route::put('/contract/{id}', [ContractsController::class, 'update'])->middleware('auth')->name('contracts.update');

Route::put('/signature/{contract_id}/{partner_id}', [SignatureController::class, 'store'])->middleware('auth')->name('signature.store');

Route::get('test', function () {
    return view('testsign');
});

Route::get('test/email', function () {
    Mail::to('hugojeanselme@gmail.com')->send(new WelcomMail());
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
