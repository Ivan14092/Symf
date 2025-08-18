<?php
namespace App\Shortener\Services;

use App\Shortener\Interfaces\UrlValidatorInterface;

class UrlValidator implements UrlValidatorInterface
{
    private const ALLOWED_STATUS_CODES = [200, 201, 301, 302];

    private bool $checkExists;

    public function __construct(bool $checkExists = false)
    {
        $this->checkExists = $checkExists;
    }

    public function validate(string $url): bool
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        if (!$this->checkExists) {
            return true;
        }

        $headers = @get_headers($url);
        if ($headers === false) {
            return false;
        }

        $statusLine = $headers[0] ?? '';
        foreach (self::ALLOWED_STATUS_CODES as $code) {
            if (str_contains($statusLine, (string) $code)) {
                return true;
            }
        }

        return false;
    }
}
