<?php

namespace App\Domain\Group\Http\Controllers;


use App\Domain\Group\Http\Requests\CreateGroupRequest;
use App\Domain\Group\Messages\CreateGroup;
use App\Domain\Group\Messages\RsvpUserToGroup;
use App\Dto\GroupDto;
use App\Http\Controllers\Controller;
use App\Repositories\GroupRepository;
use App\Services\AuthenticationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function store(CreateGroupRequest $request, AuthenticationService $authenticationService)
    {
        $user = $authenticationService->getAuthenticatedUser();

        $group = new GroupDto();
        $group->setName($request->get('name'));
        $group->setDescription($request->get('description'));
        $group->setOwnerUserId($user->getId());

        event(new CreateGroup($group));

        return response(null, 200);
    }

    public function rsvpUser(Request $request, AuthenticationService $authenticationService, GroupRepository $groupRepository)
    {
        $user = $authenticationService->getAuthenticatedUser();
        $group = $groupRepository->getById((int) $request->route('groupId'));

        if (!$group) {
            return new JsonResponse('group not found', 404);
        }

        event(new RsvpUserToGroup($user, $group));

        return response(null, 200);
    }

    public function getGroupUsers(Request $request, GroupRepository $groupRepository)
    {
        $users = $groupRepository->getUsersForGroup($request->route('groupId'));
        return new JsonResponse($users, 200);
    }
}
