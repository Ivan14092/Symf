<?php
namespace App\Controller;

use App\Shortener\Services\UrlEncoder;
use App\Shortener\Services\UrlDecoder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use InvalidArgumentException;

class UrlShortenerController
{
    private UrlEncoder $encoder;
    private UrlDecoder $decoder;

    public function __construct(UrlEncoder $encoder, UrlDecoder $decoder)
    {
        $this->encoder = $encoder;
        $this->decoder = $decoder;
    }

    #[Route('/encode', methods: ['POST'])]
    public function encode(Request $request): JsonResponse
    {
        $url = $request->request->get('url');

        try {
            $code = $this->encoder->encode($url);
            return new JsonResponse(['code' => $code], 201);
        } catch (InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        }
    }

    #[Route('/decode/{code}', methods: ['GET'])]
    public function decode(string $code): JsonResponse
    {
        try {
            $url = $this->decoder->decode($code);
            return new JsonResponse(['url' => $url], 200);
        } catch (InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 404);
        }
    }
}