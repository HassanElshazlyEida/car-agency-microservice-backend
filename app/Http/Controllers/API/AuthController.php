<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class AuthController
{
    use ApiResponse;

    public function register(RegisterUserRequest $request){

        $user = User::create($request->validated());

        $token = auth()->login($user);

        return $this->respondWithToken('User registered successfully',$token);
    }
    public function login(LoginUserRequest $request)
    {
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $credentials = [
            $loginField => $request->login,
            'password' => $request->password,
        ];

        if (!$token = auth()->attempt($credentials)) {
            return $this->errorResponse('Invalid login credentials', 401);
        }

        return $this->respondWithToken('User logged in successfully', $token);
    }
    public function user(Request $request){
        return new UserResource($request?->user());
    }
}
