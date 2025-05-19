<?php

namespace App\Service\NotificationService;

use App\ApiClient\BrevoApiClient;
use App\ApiClient\TelegramApiClient;
use App\Enum\ChannelEnum;
use App\Service\DeliveryLogService;
use App\Service\TelegramUserService;
use Psr\Log\LoggerInterface;

class TelegramNotificationService extends AbstractNotificationService
{
    public function __construct(
        protected BrevoApiClient $brevoApiClient,
        protected DeliveryLogService $deliveryLogService,
        protected LoggerInterface $logger,
        protected TelegramApiClient $telegramApiClient,
        private readonly TelegramUserService $telegramUserService,
    ) {
        parent::__construct($this->deliveryLogService, $this->logger);
        $this->channel = ChannelEnum::TELEGRAM->value;
    }

    public function send(int $userId, string $subject, string $body): void
    {
        $telegramUserId = $this->telegramUserService->getTelegramIdByUserId($userId);
        $this->telegramApiClient->send($telegramUserId, $body);
    }
}