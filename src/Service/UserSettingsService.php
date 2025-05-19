<?php

namespace App\Service;

use App\DTO\UserSettingsDto;
use App\Entity\UserSettings;
use App\Repository\UserSettingsRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserSettingsService
{
    public function __construct(
        private readonly UserSettingsRepository $userSettingsRepository,
        private readonly EntityManagerInterface $entityManager,
    ) {}

    public function getUserSettings(int $userId): ?UserSettings
    {
        return $this->userSettingsRepository->findOneBy(['userId' => $userId], ['createdAtTs' => 'DESC']);
    }

    public function createDefault(UserSettingsDto $dto, bool $withFlush = true): UserSettings
    {
        $userSettings = (new UserSettings())
            ->setUserId($dto->getUserId())
            ->setChannel($dto->getChannel())
            ->setTemplateId($dto->getTemplateId())
            ->setName($dto->getName())
            ->setDescription($dto->getDescription())
            ->setCreatedAtTs(time())
            ->setUpdatedAtTs(time());
        $this->entityManager->persist($userSettings);

        if ($withFlush) {
            $this->entityManager->flush();
        }

        return $userSettings;
    }
}