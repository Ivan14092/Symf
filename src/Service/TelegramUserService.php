<?php

namespace App\Service;

use App\Repository\TelegramUserRepository;

class TelegramUserService
{
    public function __construct(private readonly TelegramUserRepository $telegramUserRepository) {}

    public function getTelegramIdByUserId(int $userId): int
    {
        $telegramUser = $this->telegramUserRepository->find($userId);
        return $telegramUser->getTelegramUserId();
    }
}