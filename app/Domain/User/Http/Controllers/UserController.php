<?php

namespace App\Domain\User\Http\Controllers;

use App\Domain\User\Http\Presenters\UserPresenter;
use App\Domain\User\Http\Requests\RegistrationRequest;
use App\Domain\User\Messages\RegisterUser;
use App\Dto\UserDto;
use App\Repositories\UserRepository;
use App\Services\AuthenticationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request, UserRepository $userRepository)
    {
        $username = $request->get('username') ?? '';
        $users = $userRepository->findByUsernameLike($username);

        return new JsonResponse(
            (new UserPresenter())->collection($users),
            200
        );
    }

    public function store(RegistrationRequest $request)
    {
        $user = new UserDto();

        $user->setUsername($request->get('username'));
        $user->setEmail($request->get('email'));
        $user->setPassword(Hash::make($request->get('password')));
        $user->setApiToken(Str::random(60));

        event(new RegisterUser($user));

        return response(null, 200);
    }

    public function show(Request $request, UserRepository $userRepository)
    {
        $user = $userRepository->findByUsername($request->route('username'));

        return new JsonResponse(
            (new UserPresenter())->single($user),
            200
        );
    }

    public function indexFriends(AuthenticationService $authenticationService, UserRepository $userRepository)
    {
        $friends = $userRepository->getFriendsOfUser(
            $authenticationService->getAuthenticatedUser()->getId()
        );

        return new JsonResponse(
            (new UserPresenter())->collection($friends),
            200
        );
    }
}
