<?php

namespace App\Service\NotificationService;

use App\ApiClient\BrevoApiClient;
use App\Enum\ChannelEnum;
use App\Service\DeliveryLogService;
use Brevo\Client\ApiException;
use Brevo\Client\Model\SendSmtpEmail;
use Brevo\Client\Model\SendSmtpEmailSender;
use Brevo\Client\Model\SendSmtpEmailTo;
use Psr\Log\LoggerInterface;

class EmailNotificationService extends AbstractNotificationService
{
    public function __construct(
        protected BrevoApiClient $brevoApiClient,
        protected DeliveryLogService $deliveryLogService,
        protected LoggerInterface $logger,
    ) {
        parent::__construct($this->deliveryLogService, $this->logger);
        $this->channel = ChannelEnum::EMAIL->value;
    }

    /**
     * @throws ApiException
     */
    public function send(int $userId, string $subject, string $body): void
    {
        $email = new SendSmtpEmail([
            'sender' => new SendSmtpEmailSender(['name' => 'Mykolai Stepanenko', 'email' => 'Nikolaua36@gmail.com']),
            'to' => [new SendSmtpEmailTo(['email' => 'Nikolaua36@gmail.com', 'name' => 'Mykolai Stepanenko'])],
            'textContent' => $body,
            'subject' => $subject,
        ]);
        $this->brevoApiClient->sendEmail($email);
    }
}