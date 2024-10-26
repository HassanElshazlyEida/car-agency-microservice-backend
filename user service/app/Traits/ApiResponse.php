<?php

namespace App\Traits;

use App\Http\Resources\UserResource;

trait ApiResponse
{

    public function respondWithToken($message, $token, $statusCode = 200)
    {
        return response()->json([
            'message' => $message,
            'data'=>[
                'user'=> new UserResource(request()?->user()),
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
            ]
        ], $statusCode);
    }

    public function successResponse($data, $message = 'Success', $statusCode = 200)
    {
        if ($data instanceof \Illuminate\Http\Resources\Json\ResourceCollection) {
            return response()->json([
                'message' => $message,
                'data'=> $data->response()->getData(true), 
            ], $statusCode);
        }
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }


    public function errorResponse($message, $statusCode = 400)
    {
        return response()->json([
            'message' => $message,
        ], $statusCode);
    }
}