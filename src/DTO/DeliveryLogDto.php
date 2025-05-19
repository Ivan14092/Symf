<?php

namespace App\DTO;

class DeliveryLogDto
{
    /**
     * @param  int  $userId
     * @param  string  $channel
     * @param  string  $status
     */
    public function __construct(
        private int $userId,
        private string $channel,
        private string $status,
    ) {}

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}