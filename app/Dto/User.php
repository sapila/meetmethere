<?php

namespace App\Dto;

interface User
{
    public function setId(int $id);

    public function getId(): int;

    public function setUsername(string $username);

    public function getUsername(): string;

    public function setEmail(string $email);

    public function getEmail(): string;

    public function setPassword(string $password);

    public function getPassword(): ?string;

    public function setApiToken(string $apiToken);

    public function getApiToken(): ?string;
}
