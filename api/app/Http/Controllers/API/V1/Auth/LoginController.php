<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Domains\User\Requests\LoginUserRequest;
use App\Domains\User\Resources\PrivateUserResource;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function action(LoginUserRequest $request)
    {
        if (!$token = auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'errors' => [
                    'email' => ['Count not sign you in with those details.']
                ]
            ], 422);
        }

        return (new PrivateUserResource($request->user()))
            ->additional([
                'meta' => [
                    'token' => $token
                ]
            ]);
    }
}
