<?php

namespace App\Dto;

interface Group
{
    public function setId(int $id);

    public function getId(): int;

    public function setName(string $username);

    public function getName(): string;

    public function setDescription(string $description);

    public function getDescription(): string;

    public function setOwnerUserId(int $userId);

    public function getOwnerUserId(): int;
}
