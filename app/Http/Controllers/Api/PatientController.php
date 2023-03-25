<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PatientResource;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct(protected PatientService $patientService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = $this->patientService->getPatients();

        return PatientResource::collection($patients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
