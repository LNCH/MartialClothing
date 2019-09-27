<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Domains\User\Models\User;
use App\Domains\User\Requests\RegisterUserRequest;
use App\Domains\User\Resources\PrivateUserResource;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function action(RegisterUserRequest $request)
    {
        $user = User::create($request->only('email', 'name', 'password'));
        return new PrivateUserResource($user);
    }
}
