<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $sport = new Category();
        $sport->setName('Спорт');
        $sport->setDescription('Спорт');
        $sport->setUrl('https://miro.medium.com/v2/resize:fit:1400/1*-0h6FBi7LrNUuLYXQotZkA.jpeg');
        $manager->persist($sport);

        $health = new Category();
        $health->setName('Здоров\'я');
        $health->setDescription('Здоров\'я');
        $health->setUrl('https://www.hobartcity.com.au/files/assets/public/v/1/community/action-on-homelessness/page-images/health-with-dignity.png?dimension=pageimage&w=480');
        $manager->persist($health);

        $history = new Category();
        $history->setName('Історія');
        $history->setDescription('Історія');
        $history->setUrl('https://home.ishavana.org/learning/pluginfile.php/18235/course/overviewfiles/1.jpg');
        $manager->persist($history);

        $learning = new Category();
        $learning->setName('Навчання');
        $learning->setDescription('Навчання');
        $learning->setUrl('https://static.wixstatic.com/media/65246d_c7bd3ba476fb4191af59a11494ad027f~mv2.jpg/v1/fill/w_820,h_460,al_c,q_85/65246d_c7bd3ba476fb4191af59a11494ad027f~mv2.jpg');
        $manager->persist($learning);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['categories'];
    }
}
