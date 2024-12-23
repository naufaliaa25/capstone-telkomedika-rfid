<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RfidScanLogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// receptionist
Route::post('/patients', [PatientController::class, 'store']);
Route::post('/medical-record', [MedicalRecordController::class, 'store']); // add by receptionist

// doctor
Route::put('/medical-record/{id}', [MedicalRecordController::class, 'update']); // update by doctor
Route::get('/medical-record/{id}', [MedicalRecordController::class, 'getMedicalRecordById']);


// general
Route::get('/doctors', [UserController::class, 'getAllDoctors']);
Route::get('/patients/{rfid}', [PatientController::class, 'getPatientByRFID']);
Route::get('/medical-record/patients/{id}', [MedicalRecordController::class, 'getMedicalRecordByPatientId']); // get medical record by patient id
Route::get('/medical-record/all/patients', [MedicalRecordController::class, 'getAllMedicalRecord']); // get medical record by patient id
Route::get('/medical-record/patients/doctor/{id}', [MedicalRecordController::class, 'getAllMedicalRecordByDoctorId']); // get medical record by patient id


// for rfid device
Route::post('/rfid/logs', [RfidScanLogController::class, 'store']);

// for receptionist and doctor when scanning
Route::get('/rfid/logs/{role}', [RfidScanLogController::class, 'getLogByRole']);

// for receptionist and doctor when click button ok
Route::put('/rfid/logs/{id}', [RfidScanLogController::class, 'updateLogStatus']);