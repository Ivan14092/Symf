<?php

namespace App\Service\NotificationService;

use App\ApiClient\TelegramApiClient;
use App\Enum\ChannelEnum;

class NotificationServiceFactory
{
    public function __construct(
        private readonly EmailNotificationService $emailNotificationService,
        private readonly SmsNotificationService $smsNotificationService,
        private readonly TelegramNotificationService $telegramNotificationService,
    ) {}

    public function getNotificationService(?string $channel): NotificationServiceInterface
    {
        return match ($channel) {
            ChannelEnum::EMAIL->value => $this->emailNotificationService,
            ChannelEnum::SMS->value => $this->smsNotificationService,
            ChannelEnum::TELEGRAM->value => $this->telegramNotificationService,
            default => $this->emailNotificationService,
        };
    }
}