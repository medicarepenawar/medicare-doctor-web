<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Teleconsultation\HistoryTeleconsultationController;
use App\Http\Controllers\Teleconsultation\TeleconsultationController;
use App\Http\Controllers\VisitClinic\HistoryController;
use App\Http\Controllers\VisitClinic\InvitationController;
use App\Http\Controllers\VisitClinic\ScheduleController;
use App\Http\Controllers\Wallet\WalletController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/login', function () {
//     return view('awal.login');
// });

Route::middleware(['web', 'guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    //register|
    Route::get('/register', [RegisterController::class, 'index'])->name('doctor.register');
    Route::get('/register/options', [RegisterController::class, 'showOptions']);
    Route::get('/register/{doctorId}', [RegisterController::class, 'fromTemplate'])->name('doctor.register');
    Route::post('/register/store', [RegisterController::class, 'store']);
    Route::get('/doctor/search-template', [RegisterController::class, 'searchDoctorTemplate']);

});

Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');


Route::get('/about', function () {
    return Inertia::render('about');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/doctor/profile', [DashboardController::class, 'testing'])->name('account');
    Route::get('/doctor/order', [DashboardController::class, 'doctorInfoOrder'])->name('order');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // wallet
    Route::get('/wallet', [WalletController::class, 'index']);
    Route::get('/wallet/detail', [WalletController::class, 'transaction']);


    // Teleconsultation
    Route::get('/teleconsultation/revenue', [TeleconsultationController::class, 'index']);
    Route::get('/teleconsultation/revenue/data', [TeleconsultationController::class, 'loadTcOrderRevenue']);
    Route::get('/teleconsultation/history', [HistoryTeleconsultationController::class, 'index']);
    Route::get('/teleconsultation/history/data', [HistoryTeleconsultationController::class, 'loadTcOrderHistory']);

    // visit clinic
    Route::get('/visit-clinic/schedule', [ScheduleController::class, 'index']);
    Route::get('/visit-clinic/invitation', [InvitationController::class, 'index']);
    Route::get('/visit-clinic/history', [HistoryController::class, 'index']);
    Route::get('/visit-clinic/history/data', [HistoryController::class, 'loadVcOrderHistory']);



});
