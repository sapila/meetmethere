<?php

namespace Tests\Feature;

use App\Domain\User\Handlers\RegisterUserHandler;
use App\Domain\User\Messages\RegisterUser;
use App\Domain\User\Messages\UserRegistered;
use App\Dto\UserDto;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class RegisterUserHandlerTest extends TestCase
{
    /** @var MockObject|UserRepository */
    private $userRepository;

    /** @var RegisterUser */
    private $event;

    /** @var UserDto */
    private $inputUser;

    /** @var UserDto */
    private $outputUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = $this->createMock(UserRepository::class);

        $password = 'pass';
        $this->inputUser = new UserDto();
        $this->inputUser->setUsername('tester');
        $this->inputUser->setPassword($password);
        $this->inputUser->setEmail('test@mail.com');

        $this->outputUser = new UserDto();
        $this->outputUser->setId(5);
        $this->outputUser->setUsername('tester');
        $this->outputUser->setPassword(Hash::make($password));
        $this->outputUser->setEmail('test@mail.com');

        $this->event = new RegisterUser($this->inputUser);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_handler_emits_event_with_saved_user_on_successful_user_creation()
    {
        Event::fake();
        $this->userRepository->method('createUser')->willReturn($this->outputUser);

        $handler = new RegisterUserHandler($this->userRepository);
        $handler->handle($this->event);

        Event::assertDispatched(UserRegistered::class, function ($e) {
            return $e->user->getId() === 5;
        });
    }

    public function test_handler_does_not_emit_event_if_exceptions_is_trown()
    {
        $this->expectException(Exception::class);
        $this->userRepository->method('createUser')->willThrowException(new Exception('DB not reachable'));

        $handler = new RegisterUserHandler($this->userRepository);
        $handler->handle($this->event);

        Event::assertNotDispatched(UserRegistered::class);
    }
}
