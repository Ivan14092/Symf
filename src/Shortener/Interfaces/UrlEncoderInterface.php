<?php

namespace App\Shortener\Interfaces;

use InvalidArgumentException;

interface UrlEncoderInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function encode(string $url): string;
}