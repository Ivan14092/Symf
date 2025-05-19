<?php

namespace App\DTO;

use App\Entity\Role;

class UserDto
{
    public function __construct(
        private Role $role,
        private string $email,
        private string $password,
        private string $name,
        private string $lastname,
        private string $phone,
    ) {}

    public function getRole(): Role
    {
        return $this->role;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }
}