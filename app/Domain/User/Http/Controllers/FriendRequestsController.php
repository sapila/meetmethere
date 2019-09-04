<?php

namespace App\Domain\User\Http\Controllers;

use App\Domain\User\Messages\InitiateFriendRequest;
use App\Domain\User\Messages\UpdateFriendRequestStatus;
use App\FriendRequest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendRequestsController extends Controller
{
    public function create(Request $request)
    {
        $fromUser = Auth::user();
        $toUser = User::where('email',$request->get('email'))->first();

        if(!$toUser) {
            return new JsonResponse('User not found', 404);
        }

        // check that friend request already exists

        event(new InitiateFriendRequest(
            $fromUser->toDto(),
            $toUser->toDto()
        ));
    }

    public function patch(Request $request) // todo create validation request
    {
        $friendRequest = FriendRequest::where('id', $request->route('friendRequestId'))->first();

        if (!$friendRequest) {
            return new JsonResponse('Resource not found', 404);
        }

        event(new UpdateFriendRequestStatus($friendRequest->toDto(), $request->get('status')));
    }

}
