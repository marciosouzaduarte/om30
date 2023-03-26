<?php

namespace App\Http\Controllers\Api;

use App\Http\Auxs\HttpStatusCode;
use App\Services\PatientService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Http\Resources\PatientResource;

class PatientController extends Controller
{
    public function __construct(protected PatientService $patientService)
    {
    }

    public function index(): JsonResponse
    {
        $patients = $this->patientService->getAll();

        if (is_null($patients)) {
            return response()->json(['message' => 'patients not found'], HttpStatusCode::$NOT_FOUND);
        }

        return response()->json(PatientResource::collection($patients));
    }

    public function show(string $identify): JsonResponse
    {
        $patient = $this->patientService->getByUuid($identify);

        if (is_null($patient)) {
            return response()->json(['message' => 'patient not found'], HttpStatusCode::$NOT_FOUND);
        }

        return response()->json(new PatientResource($patient));
    }

    public function store(PatientRequest $request): JsonResponse
    {
        $patient = $this->patientService->store($request->validated());
        if (is_null($patient)) {
            return response()->json(['message' => 'patient not created'], HttpStatusCode::$BAD_REQUEST);
        }

        return response()->json(new PatientResource($patient), HttpStatusCode::$CREATED);
    }

    public function update(PatientRequest $request, string $identify): JsonResponse
    {
        if (!$this->patientService->updateByUuid($identify, $request->validated())) {
            return response()->json(['message' => 'patient not updated'], HttpStatusCode::$NOT_FOUND);
        }

        return response()->json([], HttpStatusCode::$NO_CONTENT);
    }

    public function destroy(string $identify): JsonResponse
    {
        if (!$this->patientService->deleteByUuid($identify)) {
            return response()->json(['message' => 'patient not deleted'], HttpStatusCode::$NOT_FOUND);
        }

        return response()->json([], HttpStatusCode::$NO_CONTENT);
    }
}
