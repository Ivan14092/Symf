<?php

namespace App\Service\NotificationService;

interface NotificationServiceInterface
{
    public function trySend(int $userId, string $subject, string $body): void;
}