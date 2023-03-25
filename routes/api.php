<?php

use App\Http\Controllers\Api\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/patients', [PatientController::class, 'index'])->name('index');

Route::get('/', function() {
    return response()->json(['Teste' => 'Ok']);
});
