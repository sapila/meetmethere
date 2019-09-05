<?php

namespace App\Domain\User\Http\Controllers;

use App\Domain\User\Http\Requests\LoginRequest;
use App\Services\AuthenticationService;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    public function login(LoginRequest $request, AuthenticationService $authenticationService)
    {
        $authenticated = $authenticationService->validate(
            $request->get('email'),
            $request->get('password')
        );

        if (!$authenticated) {
            return new JsonResponse('Login attempt failed', 401);
        }

        $user = User::where('email', $request->get('email'))->first();

        return new JsonResponse(
            [
                'username' => $user->username,
                'email' => $user->email,
                'api_token' => $user->api_token
            ],
            200
        );
    }
}
