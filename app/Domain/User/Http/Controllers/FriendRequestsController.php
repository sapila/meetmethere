<?php

namespace App\Domain\User\Http\Controllers;

use App\Domain\User\Messages\InitiateFriendRequest;
use App\Domain\User\Messages\UpdateFriendRequestStatus;
use App\FriendRequest;
use App\Http\Controllers\Controller;
use App\Repositories\FriendRequestRepository;
use App\Services\AuthenticationService;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FriendRequestsController extends Controller
{
    public function create(Request $request, AuthenticationService $authenticationService)
    {
        $fromUser = $authenticationService->getAuthenticatedUser();
        $toUser = User::where('username',$request->get('username'))->first();

        if(!$toUser) {
            return new JsonResponse('User not found', 404);
        }

        // check that friend request already exists

        event(new InitiateFriendRequest(
            $fromUser->toDto(),
            $toUser->toDto()
        ));
    }

    public function patch(Request $request, AuthenticationService $authenticationService, FriendRequestRepository $friendRequestRepository) // todo create validation request
    {
        $user = $authenticationService->getAuthenticatedUser();

        $friendRequest = $friendRequestRepository->findForIdAndFromUserId(
            $request->route('friendRequestId'),
            $user->id
        );

        if (!$friendRequest) {
            return new JsonResponse('Resource not found', 404);
        }

        event(new UpdateFriendRequestStatus($friendRequest->toDto(), $request->get('status')));
    }

}
