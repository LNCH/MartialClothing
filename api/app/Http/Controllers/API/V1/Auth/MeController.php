<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Domains\User\Resources\PrivateUserResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function action(Request $request)
    {
        return new PrivateUserResource($request->user());
    }
}
