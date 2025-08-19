<?php

namespace App\Shortener\Services;

use App\Shortener\Interfaces\UrlValidatorInterface;
use App\Shortener\Interfaces\StorageInterface;

class UrlEncoder
{
    private int $length;
    private UrlValidatorInterface $validator;
    private StorageInterface $storage;

    public function __construct(int $length, UrlValidatorInterface $validator, StorageInterface $storage)
    {
        $this->length = $length;
        $this->validator = $validator;
        $this->storage = $storage;
    }

    public function encode(string $url): ?string
    {
        if (!$this->validator->validate($url)) {
            return null;
        }

        do {
            $code = $this->generateCode($this->length);
        } while ($this->storage->existsCode($code));

        $this->storage->save($code, $url);

        return $code;
    }

    private function generateCode(int $length): string
    {
        return substr(bin2hex(random_bytes($length)), 0, $length);
    }
}