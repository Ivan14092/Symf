<?php

namespace App\Shortener\Services;

use App\Shortener\Interfaces\UrlValidatorInterface;
use Symfony\Component\HttpClient\HttpClient;

class UrlValidator implements UrlValidatorInterface
{
    public function validate(string $url): bool
    {
        // Перевіряємо базовий формат
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        // Перевірка доступності URL
        try {
            $client = HttpClient::create();
            $response = $client->request('GET', $url);

            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            return false;
        }
    }
}