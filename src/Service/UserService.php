<?php

namespace App\Service;

use App\DTO\UserDto;
use App\Entity\User;
use App\Enum\RoleEnum;
use App\Message\UserRegistered;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly RoleRepository $roleRepository,
    ) {}

    public function create(UserDto $dto, bool $withFlush = true): User
    {
        $userRole = $this->roleRepository->findOneBy(['name' => RoleEnum::USER->value]);
        $user = (new User())
            ->setRole($userRole)
            ->setEmail($dto->getEmail())
            ->setName($dto->getName())
            ->setLastname($dto->getLastname())
            ->setPhone($dto->getPhone());

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $dto->getPlaintextPassword(),
        );

        $user->setPassword($hashedPassword);

        $this->entityManager->persist($user);

        if ($withFlush) {
            $this->entityManager->flush();
        }

        return $user;
    }
}