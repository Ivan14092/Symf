<?php

namespace App\MessageHandler;

use App\DTO\UserSettingsDto;
use App\Enum\ChannelEnum;
use App\Message\UserRegistered;
use App\Service\UserSettingsService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;


#[AsMessageHandler]
class CreateUserSettingsWorker
{
    public function __construct(
        private readonly UserSettingsService $userSettingsService,
    ) {}

    public function __invoke(UserRegistered $event): void
    {
        $this->userSettingsService->createDefault(
            new UserSettingsDto(
                $event->getUserId(),
                ChannelEnum::EMAIL->value,
                0,
                'Email',
                'Email channel',
            ),
        );
    }
}