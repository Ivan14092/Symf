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

//        $adminUser = new User();
//        $adminUser->setName('Admin');
//        $adminUser->setLastname('Admin');
//        $adminUser->setEmail('admin@admin.admin');
//        $adminUser->setRole($admin);
//        $adminUser->setPassword('admin');
//        $adminUser->setPhone('+380911111111');
//        $manager->persist($adminUser);
//        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['users'];
    }
}
