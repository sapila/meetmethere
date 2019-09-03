<?php

namespace App\Domain\User\Http\Controllers;

use App\Domain\User\Messages\InitiateFriendRequest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendRequestsController extends Controller
{
    public function create(Request $request)
    {
        $fromUser = Auth::user();
        $toUser = User::where('email',$request->route('email'))->first();

        event(new InitiateFriendRequest(
            $fromUser->toDto(),
            $toUser->toDto()
        ));
    }
}
