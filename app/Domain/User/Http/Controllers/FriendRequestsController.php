<?php

namespace App\Domain\User\Http\Controllers;

use App\Domain\User\Messages\InitiateFriendRequest;
use App\Domain\User\Messages\UpdateFriendRequestStatus;
use App\FriendRequest;
use App\Http\Controllers\Controller;
use App\Repositories\FriendRequestRepository;
use App\Repositories\UserRepository;
use App\Services\AuthenticationService;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FriendRequestsController extends Controller
{
    public function create(Request $request, AuthenticationService $authenticationService, UserRepository $userRepository)
    {
        $fromUser = $authenticationService->getAuthenticatedUser();
        $toUser = $userRepository->findByUsername($request->get('username'));

        if(!$toUser) {
            return new JsonResponse('User not found', 404);
        }

        // check that friend request already exists

        event(new InitiateFriendRequest(
            $fromUser,
            $toUser
        ));
    }

    public function patch(Request $request, AuthenticationService $authenticationService, FriendRequestRepository $friendRequestRepository) // todo create validation request
    {
        $user = $authenticationService->getAuthenticatedUser();

        $friendRequest = $friendRequestRepository->findByIdAndFromUserId(
            $request->route('friendRequestId'),
            $user->getId()
        );

        if (!$friendRequest) {
            return new JsonResponse('Resource not found', 404);
        }

        event(new UpdateFriendRequestStatus($friendRequest, $request->get('status')));
    }

}
