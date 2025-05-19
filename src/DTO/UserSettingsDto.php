<?php

namespace App\DTO;

class UserSettingsDto
{
    public function __construct(
        private int $userId,
        private string $channel,
        private int $templateId,
        private string $name,
        private string $description,
    ) {}

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getTemplateId(): int
    {
        return $this->templateId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}