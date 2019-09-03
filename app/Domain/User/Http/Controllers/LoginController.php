<?php

namespace App\Domain\User\Http\Controllers;

use App\Domain\User\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $authenticated = Auth::validate([
            'email' => $request->get('email'),
            'password' => $request->get('password')
        ]);

        if (!$authenticated) {
            return new JsonResponse('Login attempt failed', 401);
        }

        $user = User::where('email', $request->get('email'))->first();

        return $user;
    }
}
