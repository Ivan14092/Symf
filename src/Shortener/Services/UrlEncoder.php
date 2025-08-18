<?php
namespace App\Shortener\Services;

use App\Shortener\Interfaces\UrlEncoderInterface;
use App\Shortener\Interfaces\UrlValidatorInterface;
use App\Shortener\Interfaces\StorageInterface;
use InvalidArgumentException;

class UrlEncoder implements UrlEncoderInterface
{
    private int $length;
    private UrlValidatorInterface $validator;
    private StorageInterface $storage;

    public function __construct(int $length, UrlValidatorInterface $validator, StorageInterface $storage)
    {
        if ($length < 4) {
            throw new InvalidArgumentException('Length must be at least 4');
        }
        $this->length = $length;
        $this->validator = $validator;
        $this->storage = $storage;
    }

    public function encode(string $url): string
    {
        if (!$this->validator->validate($url)) {
            throw new InvalidArgumentException('Invalid URL format');
        }

        $base64 = base64_encode($url . microtime(true));
        $safe = strtr($base64, '+/', '-_');
        $safe = rtrim($safe, '=');

        $code = substr($safe, 0, $this->length);

        $this->storage->save($code, $url);

        return $code;
    }
}