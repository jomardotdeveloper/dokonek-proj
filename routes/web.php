<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Models\Doctor;
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

Route::get('/', function () {
    return view('login');
})->name("login");

Route::get('home', function () {
    return view('frontend', ['doctors' => Doctor::all()]);
})->name("home");

Route::post('authenticate', [App\Http\Controllers\LoginController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('register', [App\Http\Controllers\LoginController::class, 'register'])->name('register');
Route::post('register-post', [App\Http\Controllers\LoginController::class, 'store'])->name('register.store');
Route::prefix("/panel")->middleware('auth')->group(function () {
    Route::resource('doctors', DoctorController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('appointments', AppointmentController::class);

    Route::resource('profiles', ProfileController::class);

    Route::get('appointments/{appointment}/approve', [App\Http\Controllers\AppointmentController::class, 'approve'])->name('appointments.approve');
    Route::get('appointments/{appointment}/reject', [App\Http\Controllers\AppointmentController::class, 'reject'])->name('appointments.reject');
    Route::get('appointments/{appointment}/finish', [App\Http\Controllers\AppointmentController::class, 'finish'])->name('appointments.finish');
    Route::get('appointments/{appointment}/ongoing', [App\Http\Controllers\AppointmentController::class, 'ongoing'])->name('appointments.ongoing');
    Route::get('appointments/{appointment}/pending', [App\Http\Controllers\AppointmentController::class, 'pending'])->name('appointments.pending');
    

    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});
