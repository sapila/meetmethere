<?php

namespace App\Dto;

interface FriendRequest
{
    public function setFromUserId(int $userId);

    public function getFromUserId(): int;

    public function setToUserId(int $userId);

    public function getToUserId(): int;

    public function setStatus(string $status);

    public function getStatus(): string;
}
