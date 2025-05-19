<?php

namespace App\Message;

class UserRegistered
{
    public function __construct(protected $userId) {}

    public function getUserId(): int
    {
        return $this->userId;
    }
}