<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use App\Enum\RoleEnum;
use App\Service\UserService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(private readonly UserService $userService) {}

    public function load(ObjectManager $manager): void
    {
        $admin = (new Role)->setName(RoleEnum::ADMIN->value);
        $user = (new Role)->setName(RoleEnum::USER->value);
        $manager->persist($admin);
        $manager->persist($user);
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['users'];
    }
}
