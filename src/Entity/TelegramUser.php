<?php

namespace App\Entity;

use App\Repository\TelegramUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TelegramUserRepository::class)]
class TelegramUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $userId;

    #[ORM\Column]
    private int $telegramUserId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getTelegramUserId(): int
    {
        return $this->telegramUserId;
    }

    public function setTelegramUserId(int $telegramUserId): void
    {
        $this->telegramUserId = $telegramUserId;
    }
}
