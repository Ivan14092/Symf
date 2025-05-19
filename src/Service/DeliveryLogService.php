<?php

namespace App\Service;

use App\DTO\DeliveryLogDto;
use App\Entity\DeliveryLog;
use App\Enum\DeliveryStatusEnum;
use Doctrine\ORM\EntityManagerInterface;

class DeliveryLogService
{
    public function __construct(private readonly EntityManagerInterface $entityManager) {}

    public function create(DeliveryLogDto $dto, bool $withFlush = true): DeliveryLog
    {
        $deliveryLog = (new DeliveryLog())
            ->setUserId($dto->getUserId())
            ->setStatus($dto->getStatus())
            ->setChannel($dto->getChannel())
            ->setSentAtTs(time());
        $this->entityManager->persist($deliveryLog);

        if ($withFlush) {
            $this->entityManager->flush();
        }

        return $deliveryLog;
    }

    public function updateDelivered(DeliveryLog $deliveryLog, bool $withFlush = true): DeliveryLog
    {
        $deliveryLog->setStatus(DeliveryStatusEnum::DELIVERED->value);
        $deliveryLog->setDeliveredAtTs(time());
        if ($withFlush) {
            $this->entityManager->flush();
        }

        return $deliveryLog;
    }

    public function updateFailed(DeliveryLog $deliveryLog, bool $withFlush = true): DeliveryLog
    {
        $deliveryLog->setStatus(DeliveryStatusEnum::FAILED->value);
        $deliveryLog->setDeliveredAtTs(time());
        if ($withFlush) {
            $this->entityManager->flush();
        }

        return $deliveryLog;
    }
}