<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use App\Services\PatientService;
use App\Http\Auxs\HttpStatusCode;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Http\Resources\PatientCollection;
use App\Http\Resources\PatientResource;

class PatientController extends Controller
{
    public function __construct(protected PatientService $patientService)
    {
    }

    public function index(int $page = 1): JsonResponse
    {
        $patients = $this->patientService->getAll($page);

        if (is_null($patients)) {
            return response()->json(['message' => 'patients not found'], HttpStatusCode::$NOT_FOUND);
        }

        return response()->json(new PatientCollection($patients));
    }

    public function show(string $identify): JsonResponse
    {
        $patient = $this->patientService->getByUuid($identify);

        if (is_null($patient)) {
            return response()->json(['message' => 'patient not found'], HttpStatusCode::$NOT_FOUND);
        }

        return response()->json(new PatientResource($patient));
    }

    public function search(string $value): JsonResponse
    {
        $patient = $this->patientService->getByNameCpf($value);

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

    public function export(string $identify = null)
    {
        $export = $this->patientService->export($identify);

        return response()->stream($export['callback'], 200, $export['headers']);
    }
}
