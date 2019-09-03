<?php

namespace App\Dto;

class FriendRequestDto implements FriendRequest
{
    /** @var int */
    private $fromUserId;

    /** @var int */
    private $toUserId;

    /** @var string */
    private $status;

    /**
     * @return int
     */
    public function getFromUserId(): int
    {
        return $this->fromUserId;
    }

    /**
     * @param int $fromUserId
     */
    public function setFromUserId(int $fromUserId): void
    {
        $this->fromUserId = $fromUserId;
    }

    /**
     * @return int
     */
    public function getToUserId(): int
    {
        return $this->toUserId;
    }

    /**
     * @param int $toUserId
     */
    public function setToUserId(int $toUserId): void
    {
        $this->toUserId = $toUserId;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}