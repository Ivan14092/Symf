<?php

namespace App\ApiClient;

use GuzzleHttp\Client;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class TelegramApiClient
{
    protected string $baseUrl;
    protected Client $telegramClient;

    public function __construct(
        #[Autowire('%env(TELEGRAM_API_KEY)%')]
        string $apiKey,
    ) {
        $this->baseUrl = "https://api.telegram.org/bot$apiKey";
        $this->telegramClient = new Client();
    }

    public function send(int $telegramUserId, string $text): void
    {
        $this->telegramClient->get($this->baseUrl . '/sendMessage', [
            'query' => [
                'chat_id' => $telegramUserId,
                'text' => $text,
            ],
        ]);
    }
}