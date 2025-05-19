<?php

namespace App\ApiClient;

use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\ApiException;
use Brevo\Client\Configuration;
use Brevo\Client\Model\SendSmtpEmail;
use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class BrevoApiClient
{
    protected TransactionalEmailsApi $brevo;

    public function __construct(
        #[Autowire('%env(BREVO_API_KEY)%')]
        string $apiKey,
    ) {
        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);
        $this->brevo = new TransactionalEmailsApi(new Client(), $config);
    }

    /**
     * @throws ApiException
     */
    public function sendEmail(SendSmtpEmail $email): void
    {
        $this->brevo->sendTransacEmail($email);
    }
}