<?php

use App\Http\Controllers\Api\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/patients/search/{value}', [PatientController::class, 'search'])->name('patient.search');
Route::put('/patients/{identify}', [PatientController::class, 'update'])->name('patient.update');
Route::delete('/patients/{identify}', [PatientController::class, 'destroy'])->name('patient.destroy');
Route::get('/patients/{identify}', [PatientController::class, 'show'])->name('patient.show');
Route::post('/patients', [PatientController::class, 'store'])->name('patient.store');
Route::get('/patients', [PatientController::class, 'index'])->name('patient.index');

Route::get('/', function() {
    return response()->json(['message' => 'OM30 Test']);
});
