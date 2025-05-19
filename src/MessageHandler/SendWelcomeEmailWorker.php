<?php

namespace App\MessageHandler;

use App\Message\UserRegistered;
use App\Service\NotificationService\NotificationServiceFactory;
use App\Service\UserSettingsService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendWelcomeEmailWorker
{
    public function __construct(
        private readonly UserSettingsService $userSettingsService,
        private readonly NotificationServiceFactory $notificationServiceFactory,
    ) {}

    public function __invoke(UserRegistered $event): void
    {
        $userSettings = $this->userSettingsService->getUserSettings($event->getUserId());
        $notificationService = $this->notificationServiceFactory->getNotificationService($userSettings?->getChannel());
        $notificationService->trySend(
            1,
            'Test email',
            'My first PHP Brevo test email!',
        );
    }
}
