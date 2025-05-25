<?php

namespace App\DataFixtures;

use App\Entity\News;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class NewsFixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(private readonly CategoryRepository $categoryRepository) {}

    public function load(ObjectManager $manager): void
    {
        $learningCategory = $this->categoryRepository->findOneBy(['name' => 'Навчання']);
        $sportCategory = $this->categoryRepository->findOneBy(['name' => 'Спорт']);
        $healthCategory = $this->categoryRepository->findOneBy(['name' => 'Здоров\'я']);
        $historyCategory = $this->categoryRepository->findOneBy(['name' => 'Історія']);

         $newsOne = new News();
         $newsOne->setTitle('Запрошуємо на День відкритих дверей КНЕУ!');
         $newsOne->setStatus('ok');
         $newsOne->setContent('Мрієте про успішну кар\'єру та якісну освіту? Хочете дізнатися більше про можливості, які відкриває перед вами один з провідних економічних університетів України? Тоді День відкритих дверей у КНЕУ — це подія, яку ви не можете пропустити!');
         $newsOne->setPublishedAt(time());
         $newsOne->setCreatedAt(time());
         $newsOne->setUpdatedAt(time());
         $newsOne->setAuthorId(555);
         $newsOne->setImgUrl('https://kneu-edu-cdn.pp.ua/files/slider/image/Banerinasayt32_1.png');
         $newsOne->setCategoryId($learningCategory->getId());
         $manager->persist($newsOne);

         $newsTwo = new News();
         $newsTwo->setTitle('Congratulations on the anniversary of Vadym Hetman Kyiv National Economic University — the first partner of Scientific Publications!');
         $newsTwo->setStatus('ok');
         $newsTwo->setContent('On today\'s 115th anniversary of the Vadym Hetman Kyiv National Economic University, we would like to congratulate our partner and recall the conclusion of the first memorandum with an institution of higher education in the history of the Scientific Publications company.');
         $newsTwo->setPublishedAt(time());
         $newsTwo->setCreatedAt(time());
         $newsTwo->setUpdatedAt(time());
         $newsTwo->setAuthorId(555);
         $newsTwo->setImgUrl('https://spubl.com.ua/web/uploads/global/kneu_en.jpg');
         $newsTwo->setCategoryId($learningCategory->getId());
         $manager->persist($newsTwo);

         $newsThree = new News();
         $newsThree->setTitle('Єдині новини. Телемарафон');
         $newsThree->setStatus('ok');
         $newsThree->setContent('Київ. Вже понад два роки з початку повномасштабного вторгнення Росії, загальнонаціональний інформаційний телемарафон "Єдині новини" залишається ключовим джерелом інформації для мільйонів українців. Створений 24 лютого 2022 року з метою координації та оперативного інформування населення в умовах воєнного стану, марафон продовжує висвітлювати події на фронті, в тилу та міжнародну підтримку України.');
         $newsThree->setPublishedAt(time());
         $newsThree->setCreatedAt(time());
         $newsThree->setUpdatedAt(time());
         $newsThree->setAuthorId(555);
         $newsThree->setImgUrl('https://static.ukrinform.com/photos/2023_02/thumb_files/630_360_1677322008-815.jpg');
         $newsThree->setCategoryId($historyCategory->getId());
         $manager->persist($newsThree);

         $newsFour = new News();
         $newsFour->setTitle('Українці Миколенко і Забарний відзначились асистами в останньому матчі АПЛ у сезоні');
         $newsFour->setStatus('ok');
         $newsFour->setContent('Два українські захисники "Евертона" і "Борнмута" — Віталій Миколенко та Ілля Забарний відповідно — відзначилися результативними передачами в останньому турі чемпіонату Англії у сезоні 2024/25.');
         $newsFour->setPublishedAt(time());
         $newsFour->setCreatedAt(time());
         $newsFour->setUpdatedAt(time());
         $newsFour->setAuthorId(555);
         $newsFour->setImgUrl('https://cdn4.suspilne.media/images/resize/1040x1.78/e1a26f14373ada4d.jpg');
         $newsFour->setCategoryId($sportCategory->getId());
         $manager->persist($newsFour);

         $newsFive = new News();
         $newsFive->setTitle('США домовляються із союзниками по НАТО про постачання Patriot Україні – Рубіо');
         $newsFive->setStatus('ok');
         $newsFive->setContent('Сполучені Штати не мають доступних систем протиповітряної оборони Patriot для передачі Україні, тому співпрацюють із союзниками по НАТО, щоб забезпечити постачання таких систем. Про це заявив державний секретар Марко Рубіо під час виступу в Сенаті США.');
         $newsFive->setPublishedAt(time());
         $newsFive->setCreatedAt(time());
         $newsFive->setUpdatedAt(time());
         $newsFive->setAuthorId(555);
         $newsFive->setImgUrl('https://detector.media/doc/images/news/archive/2021/238939/i75_ArticleImage_238939.webp');
         $newsFive->setCategoryId($historyCategory->getId());
         $manager->persist($newsFive);

         $newsSix = new News();
         $newsSix->setTitle('Що можна їсти з гречкою, щоб худнути на 5 кг за місяць: дієтологи рекомендують');
         $newsSix->setStatus('ok');
         $newsSix->setContent('Виявляється, існує максимально проста і смачна страва з гречки, яка, за словами дієтологів, здатна допомогти вам схуднути до 5 кг на місяць.');
         $newsSix->setPublishedAt(time());
         $newsSix->setCreatedAt(time());
         $newsSix->setUpdatedAt(time());
         $newsSix->setAuthorId(555);
         $newsSix->setImgUrl('https://img.tsn.ua/cached/960/tsn-fc8d4bb0191801bebf97b41f256288af/thumbs/1200x630/13/a9/4f10f82574ccd21fb8173706670ea913.jpeg');
         $newsSix->setCategoryId($healthCategory->getId());
         $manager->persist($newsSix);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['news'];
    }
}
