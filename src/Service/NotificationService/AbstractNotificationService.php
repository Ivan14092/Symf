<?php

namespace App\Service\NotificationService;

use App\DTO\DeliveryLogDto;
use App\Enum\ChannelEnum;
use App\Enum\DeliveryStatusEnum;
use App\Service\DeliveryLogService;
use Psr\Log\LoggerInterface;

abstract class AbstractNotificationService implements NotificationServiceInterface
{
    protected string $channel;

    public function __construct(
        protected DeliveryLogService $deliveryLogService,
        protected LoggerInterface $logger,
    ) {
        $this->channel = ChannelEnum::EMAIL->value;
    }

    public abstract function send(int $userId, string $subject, string $body): void;

    public function trySend(int $userId, string $subject, string $body): void
    {
        try {
            $deliveryLog = $this->deliveryLogService->create(
                new DeliveryLogDto(
                    $userId,
                    $this->channel,
                    DeliveryStatusEnum::CREATED->value,
                ),
            );

            $this->send($userId, $subject, $body);

            $deliveryLog = $this->deliveryLogService->updateDelivered($deliveryLog);
        } catch (\Throwable $exception) {
            $this->logger->error($exception);
            $this->deliveryLogService->updateFailed($deliveryLog);
        }
    }
}