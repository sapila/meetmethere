<?php

namespace App\Domain\User\Messages;

use App\Dto\User;
use Illuminate\Queue\SerializesModels;

class RegisterUser
{
    use SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
