<?php

namespace App\Http\Controllers\Api;

use App\Services\AddressService;
use App\Http\Auxs\HttpStatusCode;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;

class AddressController extends Controller
{
    public function __construct(protected AddressService $addressService)
    {
    }

    public function index()
    {
        return response()->json([], HttpStatusCode::$NO_CONTENT);
    }

    public function show(string $identify): JsonResponse
    {
        $address = $this->addressService->getByPatient($identify);

        if (is_null($address)) {
            return response()->json(['message' => 'address not found'], HttpStatusCode::$NOT_FOUND);
        }

        return response()->json(new AddressResource($address));
    }

    public function search(string $value): JsonResponse
    {
        $address = $this->addressService->getByPostCode($value);

        if (is_null($address)) {
            return response()->json(['message' => 'address not found'], HttpStatusCode::$NOT_FOUND);
        }

        return response()->json(new AddressResource($address));
    }

    public function store(AddressRequest $request, string $identify): JsonResponse
    {
        $address = $this->addressService->store($request->validated(), $identify);
        if (is_null($address)) {
            return response()->json(['message' => 'address not created'], HttpStatusCode::$BAD_REQUEST);
        }

        return response()->json(new AddressResource($address), HttpStatusCode::$CREATED);
    }

    public function update(AddressRequest $request, string $identify): JsonResponse
    {
        if (!$this->addressService->updateByPatient($identify, $request->validated())) {
            return response()->json(['message' => 'address not updated'], HttpStatusCode::$NOT_FOUND);
        }

        return response()->json([], HttpStatusCode::$NO_CONTENT);
    }

    public function destroy(string $identify): JsonResponse
    {
        if (!$this->addressService->deleteByPatient($identify)) {
            return response()->json(['message' => 'address not deleted'], HttpStatusCode::$NOT_FOUND);
        }

        return response()->json([], HttpStatusCode::$NO_CONTENT);
    }
}
