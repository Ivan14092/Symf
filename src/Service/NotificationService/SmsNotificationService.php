<?php

namespace App\Service\NotificationService;

use App\ApiClient\BrevoApiClient;
use App\DTO\DeliveryLogDto;
use App\Enum\ChannelEnum;
use App\Enum\DeliveryStatusEnum;
use App\Service\DeliveryLogService;
use Psr\Log\LoggerInterface;

class SmsNotificationService extends AbstractNotificationService
{
    public function __construct(
        protected BrevoApiClient $brevoApiClient,
        protected DeliveryLogService $deliveryLogService,
        protected LoggerInterface $logger,
    ) {
        parent::__construct($this->deliveryLogService, $this->logger);
        $this->channel = ChannelEnum::SMS->value;
    }

    public function send(int $userId, string $subject, string $body): void
    {
        $this->deliveryLogService->create(
            new DeliveryLogDto(
                $userId,
                $this->channel,
                DeliveryStatusEnum::CREATED->value,
            ),
        );
    }
}