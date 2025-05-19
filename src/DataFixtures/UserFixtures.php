<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Enum\RoleEnum;
use App\Service\UserService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserService $userService) {}

    public function load(ObjectManager $manager): void
    {
        $admin = (new Role)->setName(RoleEnum::ADMIN->value);
        $user = (new Role)->setName(RoleEnum::USER->value);
        $manager->persist($admin);
        $manager->persist($user);
        $manager->flush();

//        $this->userService->create();
    }
}
