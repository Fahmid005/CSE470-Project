<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;

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

Route::get('/home',[HomeController::class, 'redirect']);

Route::get('/',[HomeController::class, 'index']);

Route::get('/login',function() {
    return view('auth\login');
})->name('login');

Route::get('/register',function() {
    return view('auth\register');
})->name('register');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/add_doctor_view',[AdminController::class, 'addview']);

Route::post('/upload_doctor',[AdminController::class, 'upload']);

Route::post('/appointment',[HomeController::class, 'appointment']);

Route::get('/myappointment',[HomeController::class, 'myAppointment']);

Route::get('/cancel_appoint/{id}',[HomeController::class, 'cancelAppointment']);

Route::get('/show_appointment',[AdminController::class, 'showAppointment']);

Route::get('/approved/{id}',[AdminController::class, 'approved']);

Route::get('/canceled/{id}',[AdminController::class, 'canceled']);

Route::get('/show_doctor',[AdminController::class, 'showDoctor']);

Route::get('/deletedoctor/{id}',[AdminController::class, 'deleteDoctor']);

Route::get('/updatedoctor/{id}',[AdminController::class, 'updateDoctor']);

Route::post('/editdoctor/{id}',[AdminController::class, 'editDoctor']);
