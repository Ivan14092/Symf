<?php

namespace App\Shortener\Interfaces;

use InvalidArgumentException;

interface UrlDecoderInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function decode(string $code): string;
}
