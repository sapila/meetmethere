<?php

namespace App\Domain\User\Http\Controllers;

use App\Domain\User\Http\Requests\RegistrationRequest;
use App\Domain\User\Messages\RegisterUser;
use App\Dto\UserDto;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $user = new UserDto();

        $user->setUsername($request->get('username'));
        $user->setEmail($request->get('email'));
        $user->setPassword(Hash::make($request->get('password')));
        $user->setApiToken(Str::random(60));

        event(new RegisterUser($user));

        return response(null, 200);
    }
}
