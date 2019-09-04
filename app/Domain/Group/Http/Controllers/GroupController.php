<?php

namespace App\Domain\Group\Http\Controllers;


use App\Domain\Group\Messages\CreateGroup;
use App\Dto\GroupDto;
use App\Http\Controllers\Controller;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function create(Request $request, AuthenticationService $authenticationService)
    {
        $user = $authenticationService->getAuthenticatedUser();

        $group = new GroupDto();
        $group->setName($request->get('name'));
        $group->setDescription($request->get('description'));
        $group->setOwnerUserId($user->getId());

        event(new CreateGroup($group));

        return response(null, 200);
    }
}
