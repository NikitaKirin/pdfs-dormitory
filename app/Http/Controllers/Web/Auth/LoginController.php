<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\LoginRequest;
use App\Http\Resources\V1\User\UserResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return Response
     */
    public function __invoke(LoginRequest $request): Response
    {
        $credentials = $request->validated();
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response(
                [
                    'message' => __('auth.messages.success'),
                    'user' => UserResource::make(Auth::user())
                ], 200);
        }

        return response(['message' => __('auth.messages.fail')], 401);
    }
}
