<?php

namespace App\Shortener\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Shortener\Repository\ShortUrlRepository")]
#[ORM\Table(name: "short_urls")]
class ShortUrl
{
    #[ORM\Id]
    #[ORM\Column(type: "string", length: 16, unique: true)]
    private string $code;

    #[ORM\Column(type: "text")]
    private string $url;

    public function __construct(string $code, string $url)
    {
        $this->code = $code;
        $this->url = $url;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}