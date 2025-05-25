<?php

namespace App\DTO;

class UserDto
{
    public function __construct(
        private string $email,
        private string $plaintextPassword,
        private string $name,
        private string $lastname,
        private ?string $phone = null,
    ) {}

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPlaintextPassword(): string
    {
        return $this->plaintextPassword;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }
}