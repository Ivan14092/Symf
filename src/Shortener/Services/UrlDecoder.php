<?php
namespace App\Shortener\Services;

use App\Shortener\Interfaces\UrlDecoderInterface;
use App\Shortener\Interfaces\StorageInterface;
use InvalidArgumentException;

class UrlDecoder implements UrlDecoderInterface
{
    private StorageInterface $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    public function decode(string $code): string
    {
        $url = $this->storage->findUrlByCode($code);
        if ($url === null) {
            throw new InvalidArgumentException("Code '{$code}' not found");
        }
        return $url;
    }
}