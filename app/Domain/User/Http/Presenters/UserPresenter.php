<?php

namespace App\Domain\User\Http\Presenters;

use App\Dto\User;

class UserPresenter
{
    /**
     * @param User[] $users
     * @return array
     */
    public function collection(array $users): array
    {
        $collection = [];

        foreach ($users as $user) {
            $collection[] = $this->single($user);
        }

        return $collection;
    }

    public function single(User $user): array
    {
        return [
            'username' => $user->getUsername(),
            'email' => $user->getEmail()
        ];
    }
}