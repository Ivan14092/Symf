<?php
namespace App\Shortener\Interfaces;

interface StorageInterface
{
    public function save(string $code, string $url): void;
    public function findUrlByCode(string $code): ?string;
}