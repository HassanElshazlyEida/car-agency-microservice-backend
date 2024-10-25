<?php

namespace App\Traits;

trait ApiResponse
{

    public function respondWithToken($message, $token, $statusCode = 200)
    {
        return response()->json([
            'message' => $message,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ], $statusCode);
    }

    public function successResponse($data, $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }


    public function errorResponse($message, $statusCode = 400)
    {
        return response()->json([
            'error' => $message,
        ], $statusCode);
    }
}