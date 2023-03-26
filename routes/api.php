<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Addresses
Route::get('/patient/address', [AddressController::class, 'index'])->name('address.index');
Route::get('/patient/address/search/{value}', [AddressController::class, 'search'])->name('address.search');
Route::put('/patient/{identify}/address', [AddressController::class, 'update'])->name('address.update');
Route::delete('/patient/{identify}/address', [AddressController::class, 'destroy'])->name('address.destroy');
Route::get('/patient/{identify}/address', [AddressController::class, 'show'])->name('address.show');
Route::post('/patient/{identify}/address', [AddressController::class, 'store'])->name('address.store');

// Patients
Route::get('/patient/search/{value}', [PatientController::class, 'search'])->name('patient.search');
Route::put('/patient/{identify}', [PatientController::class, 'update'])->name('patient.update');
Route::delete('/patient/{identify}', [PatientController::class, 'destroy'])->name('patient.destroy');
Route::get('/patient/{identify}', [PatientController::class, 'show'])->name('patient.show');
Route::post('/patient', [PatientController::class, 'store'])->name('patient.store');
Route::get('/patient', [PatientController::class, 'index'])->name('patient.index');

Route::get('/', function() {
    return response()->json(['message' => 'OM30 Test']);
});
