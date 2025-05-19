<?php

namespace App\Entity;

use App\Repository\DeliveryLogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DeliveryLogRepository::class)]
class DeliveryLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $userId;

    #[ORM\Column]
    private string $channel;

    #[ORM\Column]
    private string $status;

    #[ORM\Column(nullable: true)]
    private int $sentAtTs;

    #[ORM\Column(nullable: true)]
    private string $deliveredAtTs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function setChannel(string $channel): self
    {
        $this->channel = $channel;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getSentAtTs(): int
    {
        return $this->sentAtTs;
    }

    public function setSentAtTs(int $sentAtTs): self
    {
        $this->sentAtTs = $sentAtTs;
        return $this;
    }

    public function getDeliveredAtTs(): string
    {
        return $this->deliveredAtTs;
    }

    public function setDeliveredAtTs(string $deliveredAtTs): self
    {
        $this->deliveredAtTs = $deliveredAtTs;
        return $this;
    }
}
