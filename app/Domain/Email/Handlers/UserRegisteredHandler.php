<?php


namespace App\Domain\Email\Handlers;

use App\Domain\Email\Messages\RegistrationEmailSent;
use App\Domain\User\Messages\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisteredHandler implements ShouldQueue
{
    /**
     * Handle user login events.
     */
    public function handle(UserRegistered $event)
    {
        var_dump('send email' . $event->user->getEmail());

        // send mail here

        event(new RegistrationEmailSent());
    }
}