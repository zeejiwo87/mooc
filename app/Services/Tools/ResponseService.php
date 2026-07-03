<?php

namespace App\Services\Tools;

use Illuminate\Http\JsonResponse;

final class ResponseService
{
    public function data(array $data, int $statusCode = 200): JsonResponse
    {
        return response()->json($data, $statusCode);
    }

    public function errorResponse(string $message, int $statusCode = 400, $data = null): JsonResponse
    {
        $payload = ['success' => false, 'message' => $message];
        if (! is_null($data)) {
            $payload['data'] = $data;
        }

        return response()->json($payload, $statusCode);
    }

    public function successResponse(string $message, $data = null, int $statusCode = 200): JsonResponse
    {
        return response()->json(['success' => true, 'message' => $message, 'data' => $data], $statusCode);
    }
}
