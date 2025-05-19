<?php

namespace App\Service;

use App\DTO\UserDto;
use App\Entity\User;
use App\Message\UserRegistered;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class UserService
{
    public function __construct(private readonly EntityManagerInterface $entityManager,
        private readonly MessageBusInterface $messageBus
    ) {}

    public function create(UserDto $dto, bool $withFlush = true): User
    {
        $user = (new User())
            ->setRole($dto->getRole())
            ->setEmail($dto->getEmail())
            ->setName($dto->getName())
            ->setLastname($dto->getLastname())
            ->setPhone($dto->getPhone());
        $this->entityManager->persist($user);

        if ($withFlush) {
            $this->entityManager->flush();
        }

        $this->messageBus->dispatch(new UserRegistered($user->getId()));

        return $user;
    }
}