<?php

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

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth'])->name('dashboard');

Route::get('/scan', function () {
    return view('scan.index');
})->middleware(['auth']);

Route::get('/scan-patient-registration', function () {
    return view('scan.receptionist.patient-registration.index');
})->middleware(['auth']);

Route::get('/scan-patient-list-medical-records', function () {
    return view('scan.receptionist.patient-medical-records.index');
})->middleware(['auth']);

Route::get('/scan-patient-detail-medical-record', function () {
    return view('scan.receptionist.patient-medical-records.detail');
})->middleware(['auth']);

Route::get('/scan-patient-add-medical-record', function () {
    return view('scan.receptionist.patient-medical-records.add');
})->middleware(['auth']);

Route::get('/scan-patient-doctor-ack-medical-record', function () {
    return view('scan.receptionist.patient-medical-records.doctor-ack');
})->middleware(['auth']);

Route::get('/login', function () {
    return view('login-admin.index');
})->middleware(['auth']);

require __DIR__.'/auth.php';
