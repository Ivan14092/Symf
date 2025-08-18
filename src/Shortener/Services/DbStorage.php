<?php
namespace App\Shortener\Services;

use App\Shortener\Interfaces\StorageInterface;
use App\Shortener\Entity\ShortUrl;
use Doctrine\ORM\EntityManagerInterface;

class DbStorage implements StorageInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function save(string $code, string $url): void
    {
        $shortUrl = new ShortUrl($code, $url);
        $this->em->persist($shortUrl);
        $this->em->flush();
    }

    public function findUrlByCode(string $code): ?string
    {
        $shortUrl = $this->em->getRepository(ShortUrl::class)->find($code);
        return $shortUrl?->getUrl();
    }
}