<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    #[Route('/login', name: 'login', methods: ['GET'])]
    public function getLoginPage(): Response
    {
        return $this->render('pages/login.html.twig');
    }

    #[Route(path: "/login", name: 'app_login', methods: 'POST')]
    public function login(): JsonResponse
    {
        return new JsonResponse('login success 123');
    }

    #[Route('/register', name: 'register', methods: ['GET'])]
    public function getRegisterPage(): Response
    {
        return $this->render('pages/register.html.twig');
    }
}
