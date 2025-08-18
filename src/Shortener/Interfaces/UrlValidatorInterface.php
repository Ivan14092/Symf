<?php
namespace App\Shortener\Interfaces;

interface UrlValidatorInterface
{
    public function validate(string $url): bool;
}