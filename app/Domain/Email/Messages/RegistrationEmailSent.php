<?php

namespace App\Domain\Email\Messages;

use App\Dto\User;
use Illuminate\Queue\SerializesModels;

class RegistrationEmailSent
{
    use SerializesModels;
}
