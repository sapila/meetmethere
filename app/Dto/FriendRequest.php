<?php

namespace App\Dto;

interface FriendRequest
{
    public const FRIEND_REQUEST_PENDING = 'pending';
    public const FRIEND_REQUEST_ACCEPTED = 'accepted';
    public const FRIEND_REQUEST_REJECTED = 'rejected';

    public function setId(int $id);

    public function getId(): int;

    public function setFromUserId(int $userId);

    public function getFromUserId(): int;

    public function setToUserId(int $userId);

    public function getToUserId(): int;

    public function setStatus(string $status);

    public function getStatus(): string;
}
