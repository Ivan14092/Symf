<?php

namespace App\Shortener\Services;

use App\Shortener\Interfaces\StorageInterface;
use PDO;

class DbStorage implements StorageInterface
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(string $code, string $url): void
    {
        $stmt = $this->connection->prepare("INSERT INTO urls (code, url) VALUES (:code, :url)");
        $stmt->execute(['code' => $code, 'url' => $url]);
    }

    public function findUrlByCode(string $code): ?string
    {
        $stmt = $this->connection->prepare("SELECT url FROM urls WHERE code = :code LIMIT 1");
        $stmt->execute(['code' => $code]);
        $result = $stmt->fetchColumn();

        return $result !== false ? $result : null;
    }

    public function existsCode(string $code): bool
    {
        $stmt = $this->connection->prepare("SELECT COUNT(*) FROM urls WHERE code = :code");
        $stmt->execute(['code' => $code]);

        return $stmt->fetchColumn() > 0;
    }
}