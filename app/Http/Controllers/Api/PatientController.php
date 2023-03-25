<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Http\Resources\PatientResource;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct(protected PatientService $patientService) {}

    public function index()
    {
        $patients = $this->patientService->get();

        return PatientResource::collection($patients);
    }

    public function store(PatientRequest $request)
    {
        $patient = $this->patientService->store($request->validated());

        return new PatientResource($patient);
    }

    public function show($identify)
    {
        $patient = $this->patientService->getByUuid($identify);

        return new PatientResource($patient);
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
